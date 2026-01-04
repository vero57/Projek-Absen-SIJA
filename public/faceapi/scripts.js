// =====================================
// GLOBAL VARIABLES
// =====================================
let labeledFaceDescriptors = [];
let faceMatcher;


// =====================================
// LOAD DATABASE
// =====================================
async function loadFaceDatabase() {
    const res = await fetch("/faceapi/user-image");
    const data = await res.json();

    if (!data.photo_url) {
        console.error("Foto tidak ditemukan di student_details");
        return;
    }

    const img = await faceapi.fetchImage(data.photo_url);

    const detection = await faceapi
        .detectSingleFace(img)
        .withFaceLandmarks()
        .withFaceDescriptor();

    if (!detection) {
        console.warn("Wajah tidak terdeteksi dari foto database");
        return;
    }

    labeledFaceDescriptors.push(
        new faceapi.LabeledFaceDescriptors(data.name, [detection.descriptor])
    );

    console.log("Loaded dynamic face:", data.name);

    faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
}



// =====================================
// MAIN PROGRAM
// =====================================
async function run() {
    await Promise.all([
        faceapi.nets.ssdMobilenetv1.loadFromUri('/faceapi/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/faceapi/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/faceapi/models'),
        faceapi.nets.ageGenderNet.loadFromUri('/faceapi/models'),
        faceapi.nets.faceExpressionNet.loadFromUri('/faceapi/models'), // ⭐ NEW
    ]);

    console.log("Models loaded!");

    await loadFaceDatabase();
    console.log("Face database loaded!");

    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");


    // Kamera langsung aktif tanpa tombol
    video.style.display = "block";
    navigator.mediaDevices.getUserMedia({ video: {} })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Gagal mengakses kamera:", err);
        });

    // canvas di-resize saat metadata video sudah siap
    video.addEventListener("loadedmetadata", () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
    });

    video.addEventListener("playing", () => {
        if (video.videoWidth === 0 || video.videoHeight === 0) {
            console.warn("Video belum siap, dimensi 0");
            return;
        }
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext("2d");


        // Ambil elemen label, deskripsi, dan gambar ekspresi di kontainer kiri
        const ekspresiLabel = document.querySelector('.absen-left h2');
        const ekspresiDesc = document.querySelector('.absen-left p');
        const ekspresiImgBox = document.querySelector('.absen-left .aspect-square');
        // Mapping ekspresi ke gambar
        const ekspresiImages = {
            happy:   { src: '/assets/images/landing/expression/smile.png', label: 'Senyum 😊' },
            neutral: { src: '/assets/images/landing/expression/flat.png',  label: 'Datar 😐' },
            sad:     { src: '/assets/images/landing/expression/gloomy.png', label: 'Sedih 😢' },
            angry:   { src: '/assets/images/landing/expression/angry.png',  label: 'Marah 😠' },
            surprised: { src: '/assets/images/landing/expression/surprised.png', label: 'Terkejut 😲' },
            disgusted: { src: '/assets/images/landing/expression/disgusted.png', label: 'Jijik 🤢' },
            fearful:   { src: '/assets/images/landing/expression/fearful.png', label: 'Takut 😨' }
        };

        setInterval(async () => {
            if (video.videoWidth === 0 || video.videoHeight === 0) return;

            const detections = await faceapi.detectAllFaces(video)
                .withFaceLandmarks()
                .withFaceDescriptors()
                .withAgeAndGender()
                .withFaceExpressions();

            const resized = faceapi.resizeResults(detections, {
                width: video.videoWidth,
                height: video.videoHeight
            });

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            let ekspresiTerdeteksi = null;
            let confidence = 0;

            resized.forEach(face => {
                // -------------------------
                //  FACE RECOGNITION
                // -------------------------
                const bestMatch = faceMatcher.findBestMatch(face.descriptor);
                const label = bestMatch.label;

                const box = face.detection.box;
                const drawBox = new faceapi.draw.DrawBox(box, {
                    label: label
                });
                drawBox.draw(canvas);

                // -------------------------
                //  DETEKSI EKSPRESI
                // -------------------------
                const exp = face.expressions;

                // Cari ekspresi dominan
                const dominant = Object.entries(exp).sort((a,b)=>b[1]-a[1])[0];
                ekspresiTerdeteksi = dominant[0];
                confidence = dominant[1];
            });

            // Tampilkan ekspresi di kontainer kiri jika ada wajah terdeteksi
            if (ekspresiLabel && ekspresiTerdeteksi) {
                let labelText = '';
                let descText = '';
                let imgSrc = '';
                let imgAlt = '';
                if (ekspresiImages[ekspresiTerdeteksi]) {
                    labelText = ekspresiImages[ekspresiTerdeteksi].label;
                    imgSrc = ekspresiImages[ekspresiTerdeteksi].src;
                    imgAlt = ekspresiImages[ekspresiTerdeteksi].label;
                } else {
                    labelText = ekspresiTerdeteksi;
                    imgSrc = '';
                    imgAlt = ekspresiTerdeteksi;
                }
                descText = 'Ekspresi: ' + labelText.replace(/\s.*/, '') + ` (${ekspresiTerdeteksi.charAt(0).toUpperCase() + ekspresiTerdeteksi.slice(1)})`;
                ekspresiLabel.textContent = labelText;
                if (ekspresiDesc) {
                    ekspresiDesc.textContent = descText + ` (Confidence: ${(confidence*100).toFixed(1)}%)`;
                }
                if (ekspresiImgBox && imgSrc) {
                    ekspresiImgBox.innerHTML = `<img src="${imgSrc}" alt="${imgAlt}" class="w-full h-full object-contain">`;
                }
            }
        }, 150);
    });
}

run();
