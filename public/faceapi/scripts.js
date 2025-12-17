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

                const sad    = exp.sad;
                const mad    = exp.angry;
                const smile  = exp.happy;
                const flat   = exp.neutral;

                const dominant = Object.entries(exp).sort((a,b)=>b[1]-a[1])[0][0];

                console.log(`Ekspresi terdeteksi: ${dominant.toUpperCase()}`);

                if (sad > 0.6)   console.log("ni orang SAD");
                if (mad > 0.6)   console.log("ni orang MAD");
                if (smile > 0.6) console.log("ni orang SMILING");
                if (flat > 0.6)  console.log("ni orang FLAT / NEUTRAL");
            });

        }, 150);
    });
}

run();
