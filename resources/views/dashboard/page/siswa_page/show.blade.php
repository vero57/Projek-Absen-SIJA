@extends('dashboard.layout.app', ['title' => 'Halaman Detail Siswa'])

@section('content')
<div class="content-section mx-auto">
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 mb-6">
        <div class="flex items-center gap-4">
            <i class="fas fa-user-graduate text-4xl text-blue-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Detail Siswa</h3>
                <p class="text-slate-400">Halaman ini digunakan untuk melihat detail tiap-tiap siswa yang ada.</p>
            </div>
        </div>
    </div>

    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Nama</h5>
                <p class="text-white text-lg">{{ $user->name }}</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Email</h5>
                <p class="text-white text-lg">{{ $user->email ?? '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Jenis Kelamin</h5>
                <p class="text-white text-lg">{{ $user->gender ?? '-' }}</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Foto</h5>
                <p class="text-white text-lg">
                    @if($user && $user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto" class="w-12 h-12 object-cover rounded" />
                    @else
                        <span class="text-slate-400">-</span>
                    @endif
                </p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">NIS</h5>
                <p class="text-white text-lg">{{ $user->nis ?? '-' }}</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">NISN</h5>
                <p class="text-white text-lg">{{ $user->nisn ?? '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Kelas</h5>
                <p class="text-white text-lg">{{ $user->birth_place ?? '-' }}</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Jenis Kelamin</h5>
                <p class="text-white text-lg">{{ ($user && $user->birth_date) ? \Carbon\Carbon::parse($user->birth_date)->format('d-m-Y') : '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Tempat Lahir</h5>
                <p class="text-white text-lg">{{ $user->birth_place ?? '-' }}</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Tanggal Lahir</h5>
                <p class="text-white text-lg">{{ ($user && $user->birth_date) ? \Carbon\Carbon::parse($user->birth_date)->format('d-m-Y') : '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Alamat</h5>
                <p class="text-white text-lg">{{ $user->address ?? '-' }}</p>
            </div>

        </div>

    </div>
</div>
@endsection
