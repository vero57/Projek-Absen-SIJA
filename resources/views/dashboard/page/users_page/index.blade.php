@extends(
    "dashboard.layout.app",
    [
        "title" => "Users",
    ]
)

@section('content')
<div class="content-section">
    <div class="bg-slate-800/50 flex flex-row items-center justify-between backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="flex items-center gap-4">
            <i class="fas fa-users text-4xl text-green-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">User</h3>
                <p class="text-slate-400">Daftar Semua Akun User.</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ route('dashboard.users.create') }}"><button type="button" class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Tambah Data User</button></a>
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
                <input type="search" placeholder="Cari nama/email" class="bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                <button class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Search</button>
            </div>
        </div>

        <div class="overflow-x-auto -mx-4 px-4">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="text-left text-slate-300 text-sm uppercase tracking-wider">
                        <th class="px-4 py-3">Nama User</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">No HP</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @if(isset($users) && $users->count())
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $user->phone_number ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    @if($user->role)
                                        <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-slate-700 mr-1">{{ $user->role->name }}</span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="inline-block" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs font-semibold">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    {{-- @else
                        @for($i=1;$i<=5;$i++)
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-4 py-3 text-slate-200 text-sm">User {{ $i }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">user{{ $i }}@mail.com</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">08{{ rand(100000000,999999999) }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-slate-700 mr-1">user</span>
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    <a href="#" class="inline-block bg-yellow-500 text-slate-900 px-3 py-1 rounded text-xs font-semibold mr-2"><i class="fas fa-edit"></i> Edit</a>
                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold" disabled><i class="fas fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                        @endfor --}}
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between text-slate-400 text-sm">
            <div>Showing <span class="text-white">1</span> to <span class="text-white">10</span> of <span class="text-white">100</span> entries</div>
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
            text: `User "${userName}" akan dihapus secara permanen.`,
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

