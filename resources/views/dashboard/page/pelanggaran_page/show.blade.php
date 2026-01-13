@extends(
    "dashboard.layout.app",
    [
        "title" => "Detail Jurnal Siswa",
    ]
)

@section('content')
<div class="content-section mx-auto">
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 mb-6 flex flex-row items-center justify-between">
        <div class="flex items-center gap-4">
            <i class="fas fa-exclamation-triangle text-4xl text-red-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Detail Pelanggaran Siswa</h3>
                <p class="text-slate-400">Halaman ini digunakan untuk melihat detail daftar pelanggaran siswa — tanggal, jam, status, dan lokasi.</p>
            </div>
        </div>
        <div>
            <a href="{{ route('dashboard.pelanggaran') }}"><button type="button" class="bg-red-600 hover:bg-red-500 text-white px-3 py-2 rounded text-sm"><i class="fas fa-arrow-left"></i> Kembali</button></a>
        </div>
    </div>

    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Nama</h5>
                <p class="text-white text-lg">-</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Kelas</h5>
                <p class="text-white text-lg">-</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Tanggal</h5>
                <p class="text-white text-lg">-</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Ketentuan</h5>
                <p class="text-white text-lg">-</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Deskripsi</h5>
                <p class="text-white text-lg">-</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Hukuman</h5>
                <p class="text-white text-lg">-</p>
            </div>

        </div>

    </div>
</div>
@endsection
