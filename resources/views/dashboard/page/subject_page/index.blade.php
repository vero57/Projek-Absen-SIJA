@extends(
    "dashboard.layout.app",
    [
        "title" => "Mata Pelajaran",
    ]
)

@section('content')
<div class="content-section">
    <div class="bg-slate-800/50 flex flex-row items-center justify-between backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="flex items-center gap-4">
            <i class="fas fa-book text-4xl text-green-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Mata Pelajaran</h3>
                <p class="text-slate-400">Daftar Mata Pelajaran.</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ route('dashboard.subjects.create') }}"><button type="button" class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Tambah Mata Pelajaran</button></a>
        </div>
    </div>

    <div class="mt-6 bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
            <div class="flex items-center gap-3">
                <label class="text-slate-300 text-sm">Show</label>
                <select class="bg-slate-900 text-slate-200 border border-slate-700 rounded px-2 py-1 text-sm">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <input type="search" placeholder="Cari nama kelas" class="bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                <button class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Search</button>
            </div>
        </div>

        <div class="overflow-x-auto -mx-4 px-4">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="text-left text-slate-300 text-sm uppercase tracking-wider">
                        <th class="px-4 py-3">Nama Mata Pelajaran</th>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3">Guru</th>
                        <th class="px-4 py-3 w-[200px]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                @if(isset($subjects) && $subjects->count())
                    @foreach($subjects as $classSubject)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 text-slate-200 text-sm">{{ $classSubject->subject->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-200 text-sm">{{ $classSubject->class->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-200 text-sm">{{ $classSubject->teacher->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-200 text-sm">
                                <a href="{{ route('dashboard.subjects.edit', $classSubject->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form id="delete-form-{{ $classSubject->id }}" action="{{ route('dashboard.subjects.destroy', $classSubject->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $classSubject->id }}', '{{ $classSubject->subject->name ?? 'Mata Pelajaran' }}')" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs font-semibold">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between text-slate-400 text-sm">
            <div>Showing <span class="text-white">{{ $subjects->firstItem() }}</span> to <span class="text-white">{{ $subjects->lastItem() }}</span> of <span class="text-white">{{ $subjects->total() }}</span> entries</div>
            @if(isset($subjects) && method_exists($subjects, 'links'))
                <div class="text-sm">
                    {{ $subjects->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    function confirmDelete(id, subjectName) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Mata pelajaran "${subjectName}" akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush
