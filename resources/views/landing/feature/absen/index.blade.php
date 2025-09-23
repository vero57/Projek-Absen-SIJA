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
                    <svg class="w-20 h-20 text-indigo-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h2l2-3h10l2 3h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2zm9 4a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <div class="text-center">
                        <h2 class="text-lg font-semibold text-slate-100 mb-2">Ini adalah tempat kamera</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('script')
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
    });
</script>
@endpush