@extends("landing.layout.app", ["title" => "Absen SIJA"])

@push("style")
<style>
    .absen-container {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .absen-left, .absen-right {
        width: 50%;
        min-height: 400px;
        background: rgba(255,255,255,0.05);
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        backdrop-filter: blur(10px);
    }
    @media (max-width: 900px) {
        .absen-container {
            flex-direction: column;
        }
        .absen-left, .absen-right {
            width: 100%;
            margin-bottom: 1.5rem;
        }
    }
    /* Loader animation */
    .loader {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #6366f1;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg);}
        100% { transform: rotate(360deg);}
    }
    /* Ensure video/canvas fits container */
    #cameraContainer {
        position: relative;
        width: 100%;
        height: 340px; /* or use 100% if parent is fixed */
        max-width: 450px;
    }
    #video, #canvas {
        width: 100% !important;
        height: 100% !important;
        border-radius: 1rem;
        display: block;
    }
    #canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events: none;
    }
</style>
@endpush

@section("content")
<section class="min-h-screen text-slate-200">
    <div class="container mx-auto px-6 py-8">
        @include("landing.partials.header")
        <div class="text-center mb-10">
            <h1 class="text-2xl font-bold text-slate-100 mb-2">Absen SIJA</h1>
            <p class="text-slate-400">Silakan lakukan absensi atau lihat riwayat absensi Anda di bawah ini.</p>
        </div>
        <div class="absen-container">
            <!-- Kontainer Kiri -->
            <div class="absen-left flex flex-col items-center justify-center">
                <!-- Kotak Rasio 1:1 -->
                <div class="w-48 aspect-square bg-slate-800 rounded-xl flex items-center justify-center mb-6">
                    {{-- Gambar ekspresi random akan diisi oleh JS di bawah --}}
                </div>
                <div class="text-center px-4">
                    <h2 class="text-lg font-semibold text-slate-100 mb-2">SMILE😊</h2>
                    <p class="text-slate-400">Ikuti perintah teks diatas untuk melakukan absen</p>
                </div>
            </div>
            <!-- Kontainer Kanan -->
            <div class="absen-right flex items-center justify-center">
                <div class="w-full h-full p-8 flex flex-col items-center justify-center">
                    <!-- Loading animation -->
                    <div id="cameraLoading" class="flex flex-col items-center justify-center w-full h-full">
                        <div class="loader mb-4"></div>
                        <div class="text-slate-400">Memulai kamera...</div>
                    </div>
                    <!-- Kamera & Canvas -->
                    <div id="cameraContainer" style="display:none; width:100%; height:100%;" class="flex flex-col items-center justify-center">
                        <video id="video" autoplay muted style="width:100%; height:100%; object-fit:cover; border-radius:1rem; background:#222; display:block;"></video>
                        <canvas id="canvas" style="width:100%; height:100%; position:absolute; left:0; top:0;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/faceapi/face-api.min.js"></script>
<script src="/faceapi/scripts.js"></script>
<script>
    const absenImages = [
        {
            src: '/assets/images/landing/expression/smile.png',
            label: 'Senyum'
        },
        {
            src: '/assets/images/landing/expression/flat.png',
            label: 'Datar'
        },
        {
            src: '/assets/images/landing/expression/gloomy.png',
            label: 'Murung'
        }
    ];

    const randomIndex = Math.floor(Math.random() * absenImages.length);
    const selected = absenImages[randomIndex];

    document.addEventListener('DOMContentLoaded', function() {
        const box = document.querySelector('.absen-left .aspect-square');
        if (box) {
            box.innerHTML = `<img src="${selected.src}" alt="${selected.label}" class="w-full h-full object-contain">`;
        }

        const label = document.querySelector('.absen-left h2');
        if (label) {
            label.textContent = selected.label;
        }

        // Update instruksi agar sesuai ekspresi random
        const desc = document.querySelector('.absen-left p');
        if (desc) {
            desc.textContent = `Tirukan ekspresi "${selected.label}" pada gambar di atas untuk melakukan absen`;
        }

        // Otomatis jalankan kamera
        const video = document.getElementById("video");
        const canvas = document.getElementById("canvas");
        const cameraLoading = document.getElementById("cameraLoading");
        const cameraContainer = document.getElementById("cameraContainer");

        // Otomatis jalankan kamera
        navigator.mediaDevices.getUserMedia({ video: {} })
            .then(stream => {
                video.srcObject = stream;
                video.onloadedmetadata = () => {
                    cameraLoading.style.display = "none";
                    cameraContainer.style.display = "flex";
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                };
            })
            .catch(err => {
                cameraLoading.innerHTML = "<div class='text-red-500'>Gagal mengakses kamera: " + err.message + "</div>";
            });

        // Simpan ekspresi yang harus ditiru
        const ekspresiHarus = selected.label.toLowerCase(); // e.g. "senyum", "datar", "murung"
        // Mapping label ke ekspresi face-api
        const ekspresiMap = {
            'senyum': 'happy',
            'datar': 'neutral',
            'murung': 'sad'
        };
        const ekspresiTarget = ekspresiMap[ekspresiHarus] || 'neutral';

        // Timer deteksi ekspresi
        let ekspresiBenarStart = null;
        let absenBerhasil = false;

        // Patch scripts.js: deteksi ekspresi benar selama 3 detik
        window.absenEkspresiCheck = function(ekspresiTerdeteksi, confidence, faceLabel) {
            if (absenBerhasil) return;
            // Hanya lanjut jika wajah adalah user (bukan unknown)
            if (faceLabel === "unknown" || !faceLabel) {
                const ekspresiDetected = document.querySelector('.absen-left .ekspresi-terdeteksi');
                if (ekspresiDetected) {
                    ekspresiDetected.innerHTML = "<span style='color:#f87171;'>Wajah tidak dikenali sebagai user. Absen tidak bisa dikirim.</span>";
                }
                ekspresiBenarStart = null;
                return;
            }
            if (ekspresiTerdeteksi === ekspresiTarget && confidence > 0.85) {
                if (!ekspresiBenarStart) {
                    ekspresiBenarStart = Date.now();
                }
                const durasi = (Date.now() - ekspresiBenarStart) / 1000;
                const ekspresiDetected = document.querySelector('.absen-left .ekspresi-terdeteksi');
                if (ekspresiDetected) {
                    ekspresiDetected.innerHTML += `<br><span style="color:#4ade80;">Tahan ekspresi: ${durasi.toFixed(1)}s / 3s</span>`;
                }
                if (durasi >= 3) {
                    absenBerhasil = true;
                    // Wajib akses lokasi sebelum absen
                    if (navigator.geolocation) {
                        ekspresiDetected.innerHTML = "Mengambil lokasi...";
                        navigator.geolocation.getCurrentPosition(function(pos) {
                            // Validasi radius sekolah
                            const schoolLat = -6.521976890944639;
                            const schoolLng = 106.80741031694744;
                            const radiusMeter = 100;
                            const userLat = pos.coords.latitude;
                            const userLng = pos.coords.longitude;
                            const distance = getDistanceFromLatLonInMeters(userLat, userLng, schoolLat, schoolLng);
                            if (distance > radiusMeter) {
                                absenBerhasil = false;
                                stopCameraAndBack("Anda berada di luar radius sekolah (" + distance.toFixed(1) + " meter). Absen tidak bisa dilakukan.");
                                return;
                            }
                            submitAbsen(userLat, userLng, faceLabel);
                        }, function(err) {
                            stopCameraAndBack("Izin lokasi diperlukan untuk absen.");
                            absenBerhasil = false;
                        }, { enableHighAccuracy: true });
                    } else {
                        stopCameraAndBack("Browser tidak mendukung geolokasi.");
                        absenBerhasil = false;
                    }
                }
            } else {
                ekspresiBenarStart = null;
            }
        };

        function stopCameraAndBack(message) {
            // Stop camera stream
            try {
                const video = document.getElementById("video");
                if (video && video.srcObject) {
                    video.srcObject.getTracks().forEach(track => track.stop());
                    video.srcObject = null;
                }
            } catch (e) {}
            // Swal + redirect
            Swal.fire({
                icon: 'error',
                title: 'Absen Gagal',
                text: message,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "/";
            });
        }

        // Haversine formula untuk hitung jarak dua titik koordinat (meter)
        function getDistanceFromLatLonInMeters(lat1, lon1, lat2, lon2) {
            const R = 6371000; // Radius bumi dalam meter
            const dLat = (lat2-lat1) * Math.PI/180;
            const dLon = (lon2-lon1) * Math.PI/180;
            const a =
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1 * Math.PI/180) * Math.cos(lat2 * Math.PI/180) *
                Math.sin(dLon/2) * Math.sin(dLon/2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            return R * c;
        }

        function submitAbsen(lat, lng, faceLabel) {
            const ekspresiDetected = document.querySelector('.absen-left .ekspresi-terdeteksi');
            ekspresiDetected.innerHTML = "Mengirim absen...";

            // Ambil foto dari video (canvas)
            const video = document.getElementById("video");
            const canvas = document.createElement("canvas");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoData = canvas.toDataURL("image/jpeg", 0.92); // base64 jpeg

            fetch("{{ route('feature.absen.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    ekspresi: ekspresiTarget,
                    lat: lat,
                    lng: lng,
                    photo: photoData,
                    face_label: faceLabel
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Swal notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Absen Berhasil',
                        text: 'Terima kasih, absensi Anda telah tercatat!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "/";
                    });
                } else {
                    ekspresiDetected.innerHTML = "<span style='color:#f87171;'>Gagal absen: "+(data.message||'')+"</span>";
                    absenBerhasil = false;
                }
            })
            .catch(()=>{
                ekspresiDetected.innerHTML = "<span style='color:#f87171;'>Gagal mengirim absen.</span>";
                absenBerhasil = false;
            });
        }
        // ...existing code...
    });
</script>
@endpush