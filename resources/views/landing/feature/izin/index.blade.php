@extends("landing.layout.app", ["title" => "Pengajuan Izin"])

@push("style")
<style>
    .izin-container {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .izin-left, .izin-right {
        width: 50%;
        max-height: 460px;
        background: rgba(255,255,255,0.05);
        border-radius: 1.5rem;
        padding: 2em;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        backdrop-filter: blur(10px);
    }
    @media (max-width: 900px) {
        .izin-container {
            flex-direction: column;
            gap: 0rem;
            margin-bottom: 0rem;

        }
        .izin-left {
            width: 100%;
            margin-bottom: 1.5rem;
        }
        .izin-right {
            width: 100%;
            padding: 2rem 1.5rem;
            max-height: 550px;
            margin-bottom: 0rem;
        }
    }
    .izin-form-input {
        font-size: 0.95rem;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
</style>
@endpush

@section("content")
<section class="min-h-screen text-slate-200">
    <div class="container mx-auto px-6 py-8">
        @include("landing.partials.header")
        <div class="text-center mb-1">
            <h1 class="text-2xl font-bold text-slate-100 mb-2">Pengajuan Izin</h1>
            <p class="text-slate-400">Isi form berikut untuk mengajukan izin (sakit, izin, atau dispensasi)</p>
        </div>
        <div class="izin-container">
            <!-- Kontainer Kiri -->
            <div class="izin-left flex flex-col items-center justify-center">
                <svg class="w-20 h-20 text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div class="text-center px-4">
                    <h2 class="text-lg font-semibold text-slate-100 mb-2">Max file 10mb</h2>
                    <p class="text-slate-400">Nanti disini buat upload file</p>
                </div>
            </div>
            <!-- Kontainer Kanan -->
            <div class="izin-right flex items-center justify-center">
                <form action="#" method="POST" class="w-full max-w-md space-y-4">
                    @csrf
                    <div>
                        <label for="nama_siswa" class="block text-slate-300 mb-1">Nama Siswa</label>
                        <input type="text" id="nama_siswa" name="nama_siswa" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    </div>
                    <div>
                        <label for="kelas_siswa" class="block text-slate-300 mb-1">Kelas Siswa</label>
                        <input type="text" id="kelas_siswa" name="kelas_siswa" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    </div>
                    <div>
                        <label for="nama_ortu" class="block text-slate-300 mb-1">Nama Orang Tua</label>
                        <input type="text" id="nama_ortu" name="nama_ortu" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    </div>
                    <div>
                        <label for="no_telp" class="block text-slate-300 mb-1">No. Telp</label>
                        <input type="text" id="no_telp" name="no_telp" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    </div>
                    <div>
                        <label for="tipe_izin" class="block text-slate-300 mb-1">Tipe Izin</label>
                        <select id="tipe_izin" name="tipe_izin" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Pilih Tipe Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="dispen">Dispen</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full max-sm:mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition">Kirim Pengajuan</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
