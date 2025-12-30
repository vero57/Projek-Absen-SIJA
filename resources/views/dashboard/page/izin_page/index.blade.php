@extends(
    "dashboard.layout.app",
    [
        "title" => "Izin Siswa",
    ]
)

@section('content')
    <div class="content-section">
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 mb-6 flex flex-row items-center justify-between">
            <div class="flex items-center gap-4">
                <i class="fas fa-file-text text-4xl text-gray-400"></i>
                <div>
                    <h3 class="text-2xl font-semibold text-white">Izin Siswa</h3>
                    <p class="text-slate-400">Daftar izin siswa — tanggal, jam, status, dan lokasi.</p>
                </div>
            </div>
            <div class="flex items-center">
                <button type="button" class="bg-gray-600 hover:bg-gray-500 text-white px-3 py-2 rounded text-sm">Ekspor Data</button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
                <div class="flex items-center gap-2">
                    <!-- <button type="button" class="tab-btn px-3 py-1 rounded text-sm font-medium bg-slate-700 text-white" data-view="student">Siswa</button> -->
                    <!-- <button type="button" class="tab-btn px-3 py-1 rounded text-sm font-medium text-slate-300 hover:text-white" data-view="class">Kelas</button> -->
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <input type="search" placeholder="Cari nama siswa / pelajaran" class="flex-1 md:flex-none bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                    <button class="bg-gray-600 hover:bg-gray-500 text-white px-3 py-2 rounded text-sm">Search</button>
                </div>
            </div>

            <div class="overflow-x-auto -mx-4 px-4">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-left text-slate-300 text-sm uppercase tracking-wider">
                            <th class="px-4 py-3 w-12">No</th>
                            <th class="px-4 py-3 col-name">Nama Siswa</th>
                            <th class="px-4 py-3">Hari, Tanggal</th>
                            <th class="px-4 py-3">Nama Orang Tua</th>
                            <th class="px-4 py-3">Jenis Izin</th>
                            <th class="px-4 py-3 w-1/6">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-700">
                        @if(isset($permissions) && $permissions->count())
                            @foreach($permissions as $idx => $p)
                                @php
                                    $no = (isset($permissions) && method_exists($permissions, 'firstItem')) ? $permissions->firstItem() + $loop->index : $loop->iteration;
                                @endphp
                                <tr class="hover:bg-slate-800/40">
                                    <td class="px-4 py-3 text-slate-200 text-sm align-center">{{ $no }}</td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-purple-700 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($p->student->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="view-student text-slate-200 font-medium text-sm">{{ $p->student->name }}</div>
                                                <div class="text-slate-400 text-xs">{{ $p->student_id ? 'ID: '.$p->student_id : '' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="font-medium">{{ $p->created_at->format('Y-m-d H:i') }}</div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-sm text-slate-200 line-clamp-2">
                                            {{ $p->parent_name ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-sm text-slate-200 line-clamp-2">
                                            {{ $p->type ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm flex">
                                        <a href="{{ route('dashboard.izin.show', $p->id) }}" class="inline-block bg-blue-500 hover:bg-blue-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <button type="button" data-id="{{ $p->id }}" onclick="openStatusModal({{ $p->id }})" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                            <i class="fas fa-edit"></i> Status
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="hover:bg-slate-800/40">
                                <td colspan="6" class="px-4 py-3 text-slate-200 text-sm text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex items-center justify-between text-slate-400 text-sm">
                <div>Showing <span class="text-white">{{ $permissions->firstItem() ?? 0 }}</span> to <span class="text-white">{{ $permissions->lastItem() ?? 0 }}</span> entries</div>
                @if(isset($permissions) && method_exists($permissions, 'links'))
                    <div class="text-sm">
                        {{ $permissions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Edit Status -->
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden" id="editStatusModal">
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 flex flex-col items-center gap-4">
            <div class="flex items-center gap-4">
                <i class="fas fa-edit text-4xl text-yellow-400"></i>
                <div>
                    <h3 class="text-2xl font-semibold text-white">Edit Status Izin</h3>
                    <p class="text-slate-400">Pilih status baru untuk izin ini.</p>
                </div>
            </div>
            <form id="statusForm" action="" method="POST" class="w-full">
                @csrf
                <input type="hidden" id="permissionId" name="permission_id" value="">
                <div class="mb-4">
                    <label for="status" class="block text-slate-300 mb-1">Status</label>
                    <select id="status" name="status" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2">
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-500 text-white px-4 py-2 rounded text-sm font-semibold">OK</button>
                    <button type="button" class="bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded text-sm font-semibold" id="closeModal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const colName = document.querySelector('.col-name');

    const showView = (view) => {
        tabButtons.forEach(b => {
            if (b.dataset.view === view) {
                b.classList.add('bg-slate-700','text-white');
                b.classList.remove('text-slate-300', 'hover:text-white');
            } else {
                b.classList.remove('bg-slate-700','text-white');
                b.classList.add('text-slate-300', 'hover:text-white');
            }
        });

        if (colName) colName.textContent = (view === 'student') ? 'Nama Siswa' : 'Kelas';

        document.querySelectorAll('.view-student').forEach(el => el.classList.toggle('hidden', view !== 'student'));
        document.querySelectorAll('.view-class').forEach(el => el.classList.toggle('hidden', view !== 'class'));
    };

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => showView(btn.dataset.view));
    });

    showView('student');
});

// Fungsi untuk membuka modal edit status
function openStatusModal(id) {
    document.getElementById('permissionId').value = id;
    document.getElementById('statusForm').action = `/dashboard/izin/${id}/update-status`; // Set action form
    document.getElementById('editStatusModal').classList.remove('hidden');
}

// Event listener untuk tombol tutup
document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('editStatusModal').classList.add('hidden');
});
</script>
@endpush
