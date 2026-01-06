@extends(
    "dashboard.layout.app",
    [
        "title" => "Detail Presensi Siswa",
    ]
)

@section('content')
<div class="content-section mx-auto">
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 mb-6 flex flex-row items-center justify-between">
        <div class="flex items-center gap-4">
            <i class="fas fa-users text-4xl text-green-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Detail Presensi Siswa</h3>
                <p class="text-slate-400">Halaman ini digunakan untuk melihat detail daftar rekaman kehadiran siswa — tanggal, jam, status, dan lokasi.</p>
            </div>
        </div>
        <div>
            <a href="{{ route('dashboard.absensi') }}"><button type="button" class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm"><i class="fas fa-arrow-left"></i> Kembali</button></a>
        </div>
    </div>

    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Nama</h5>
                <p class="text-white text-lg">{{ $attendance->student->name ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Kelas</h5>
                <p class="text-white text-lg">
                    {{ $attendance->student && $attendance->student->classes->count() ? $attendance->student->classes->pluck('name')->join(', ') : '-' }}
                </p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Tanggal</h5>
                <p class="text-white text-lg">{{ $attendance->date ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Keterangan</h5>
                <p class="text-white text-lg">{{ $attendance->status->name ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Waktu Masuk</h5>
                <p class="text-white text-lg">{{ $attendance->time_in ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Waktu Keluar</h5>
                <p class="text-white text-lg">{{ $attendance->time_out ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Lintang Lokasi</h5>
                <p class="text-white text-lg">{{ $attendance->location_lat ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Bujur Lokasi</h5>
                <p class="text-white text-lg">{{ $attendance->location_lng ?? '-' }}</p>
            </div>
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Foto</h5>
                <p class="text-white text-lg">
                    @if($attendance->photo)
                        <img src="{{ asset($attendance->photo) }}" alt="Foto" class="w-64 h-64 object-cover rounded border border-slate-700" />
                    @else
                        <span class="text-slate-400">-</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
