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
            <i class="fas fa-file-text text-4xl text-gray-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Detail Izin Siswa</h3>
                <p class="text-slate-400">Halaman ini digunakan untuk melihat detail daftar izin siswa — tanggal, jam, status, dan lokasi.</p>
            </div>
        </div>
        <div>
            <a href="{{ route('dashboard.izin') }}"><button type="button" class="bg-gray-600 hover:bg-gray-500 text-white px-3 py-2 rounded text-sm"><i class="fas fa-arrow-left"></i> Kembali</button></a>
        </div>
    </div>

    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Nama</h5>
                <p class="text-white text-lg">{{ $permission->student->name ?? '-' }}</p>
            </div>

            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Tanggal</h5>
                <p class="text-white text-lg">{{ $permission->created_at->format('Y-m-d') ?? '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Nama Orang Tua</h5>
                <p class="text-white text-lg">{{ $permission->parent_name ?? '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Jenis Izin</h5>
                <p class="text-white text-lg">{{ $permission->type ?? '-' }}</p>
            </div>


            <div>
                <h5 class="text-gray-300 text-xl font-medium mb-1">Status</h5>
                <p class="text-white text-lg">{{ $permission->status ?? '-' }}</p>
            </div>

            <div class="col-span-2">
                <h5 class="text-gray-300 text-xl font-medium mb-1">Foto</h5>
                @if($permission->files->count() > 0)
                    @foreach($permission->files as $file)
                        <img src="{{ asset('storage/' . $file->file_path) }}" alt="Foto Jurnal" class="w-32 h-32 object-cover rounded cursor-pointer hover:opacity-80" onclick="openModal('{{ asset('storage/' . $file->file_path) }}')">
                    @endforeach
                @else
                    <p class="text-slate-400">Tidak ada foto</p>
                @endif
            </div>

            <div class="col-span-2">
                <h5 class="text-gray-300 text-xl font-medium mb-1">Deskripsi</h5>
                <p class="text-white text-lg">{{ $permission->description }}</p>
            </div>

        </div>

    </div>

    <div id="imageModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="relative">
            <img id="modalImage" src="" alt="Zoomed Image" class="max-w-full max-h-full">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-black border border-white px-1 text-2xl">&times;</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}
</script>
@endpush
