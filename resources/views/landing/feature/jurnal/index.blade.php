@extends("landing.layout.app", ["title" => "Pengisian Jurnal"])

@push("style")
<style>
    .jurnal-form-box {
        background: rgba(255,255,255,0.05);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        backdrop-filter: blur(10px);
    }
</style>
@endpush

@section("content")
<section class="min-h-screen text-slate-200">
    <div class="container mx-auto px-6 py-8">
        @include("landing.partials.header")
        <div class="text-center mb-1">
            <h1 class="text-2xl font-bold text-slate-100 mb-1">Pengisian Jurnal</h1>
            <p class="text-slate-400">Pengisian Jurnal, diisi tiap mapel selesai</p>
        </div>
        <div class="jurnal-container flex mt-6 lg:mx-5">
            <div class="jurnal-form-box w-full bg-white/5 rounded-2xl p-6 lg:p-8 shadow-lg backdrop-blur-md">
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label for="pengisi_jurnal" class="block text-slate-300 mb-1">Pengisi Jurnal</label>
                        <input type="text" id="pengisi_jurnal" name="pengisi_jurnal" required class="w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label for="mata_pelajaran" class="block text-slate-300 mb-1">Mata Pelajaran</label>
                        <input type="text" id="mata_pelajaran" name="mata_pelajaran" required class="w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-slate-300 mb-1">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" required class="w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400"></textarea>
                    </div>
                    <div>
                        <label for="foto" class="block text-slate-300 mb-1">Upload Foto</label>
                        <input type="file" id="foto" name="foto" accept="image/*" required class="w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                        <p class="text-xs text-slate-400 mt-1">Max file 5mb. Format: jpg, png, jpeg</p>
                    </div>
                    <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-lg transition">Kirim Jurnal</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
