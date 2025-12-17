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
<script src="/faceapi/face-api.min.js"></script>
<script src="/faceapi/scripts.js"></script>
<script>
    const absenImages = [
        {
            src: '/assets/images/landing/expression/smile.png',
            label: 'Senyum'
        },
        {
            src: 'assets/images/landing/expression/flat.png',
            label: 'Datar'
        },
        {
            src: 'assets/images/landing/expression/gloomy.png',
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

        // Patch scripts.js: remove button logic, start faceapi when video is ready
        // You can move the faceapi logic to start when video.onplaying or onloadedmetadata fires
        // Example:
        video.addEventListener("playing", () => {
            // panggil faceapi detection logic di sini
        });
    });
</script>
@endpush