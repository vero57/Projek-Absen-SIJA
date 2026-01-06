@extends(
    "dashboard.layout.app",
    [
        "title" => "Siswa",
    ]
)

@section('content')
<div class="content-section">
    <div class="bg-slate-800/50 flex flex-row items-center justify-between backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="flex items-center gap-4">
            <i class="fas fa-user-graduate text-4xl text-blue-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Siswa</h3>
                <p class="text-slate-400">Daftar Siswa.</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ route('dashboard.users.create') }}"><button type="button" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-2 rounded text-sm">Tambah Data Siswa</button></a>
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
                <input type="search" placeholder="Cari nama/NIS/NISN" class="bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                <button class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-2 rounded text-sm">Search</button>
            </div>
        </div>

        <div class="overflow-x-auto -mx-4 px-4">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="text-left text-slate-300 text-sm uppercase tracking-wider">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">NIS</th>
                        <!-- <th class="px-4 py-3">Tempat Lahir</th> -->
                        <!-- <th class="px-4 py-3">Tanggal Lahir</th> -->
                        <!-- <th class="px-4 py-3">Alamat</th> -->
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3 w-[300px]">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                @if(isset($users) && $users->count())
                    @foreach($users as $user)
                        @php
                            $detail = $user->studentDetail;
                        @endphp
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $user->email ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $detail->gender ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $detail->nis ?? '-' }}</td>
                                <!-- <td class="px-4 py-3 text-slate-200 text-sm">{{ $detail->birth_place ?? '-' }}</td> -->
                                <!-- <td class="px-4 py-3 text-slate-200 text-sm">
                                    {{ ($detail && $detail->birth_date) ? \Carbon\Carbon::parse($detail->birth_date)->format('d-m-Y') : '-' }}
                                </td> -->
                                <!-- <td class="px-4 py-3 text-slate-200 text-sm">{{ $detail->address ?? '-' }}</td> -->
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    @if($detail && $detail->photo)
                                        <img src="{{ asset('storage/' . $detail->photo) }}" alt="Foto" class="w-12 h-12 object-cover rounded" />
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    @php $hasDetail = $detail !== null; @endphp
                                    <a href="{{ $hasDetail ? route('dashboard.siswa.detail.edit', $user->id) : route('dashboard.siswa.detail.create', $user->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                        <i class="fas fa-edit"></i> {{ $hasDetail ? 'Edit Detail' : 'Add Detail' }}
                                    </a>
                                    <a href="{{ route('dashboard.siswa.detail.show', $user->id) }}" class="inline-block bg-blue-500 hover:bg-blue-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs font-semibold">
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
            <div>Showing <span class="text-white">{{ $users->firstItem() }}</span> to <span class="text-white">{{ $users->lastItem() }}</span> of <span class="text-white">{{ $users->total() }}</span> entries</div>
            @if(isset($users) && method_exists($users, 'links'))
                <div class="text-sm">
                    {{ $users->links() }}
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

    function confirmDelete(userId, userName) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Siswa "${userName}" akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
@endpush
