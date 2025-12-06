@extends(
    "dashboard.layout.app",
    [
        "title" => "Absensi Siswa",
    ]
)

@section('content')
<div class="content-section">
    <div class="bg-slate-800/50 flex flex-row items-center justify-between backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="flex items-center gap-4">
            <i class="fas fa-users text-4xl text-green-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Absensi Siswa</h3>
                <p class="text-slate-400">Daftar rekaman absensi siswa — tanggal, jam, status, dan lokasi.</p>
            </div>
        </div>
        <div class="flex items-center">
            <button type="button" class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Ekspor Data</button>
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
                <input type="search" placeholder="Cari student_id / class_id" class="bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                <button class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Search</button>
            </div>
        </div>

        <div class="overflow-x-auto -mx-4 px-4">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="text-left text-slate-300 text-sm uppercase tracking-wider">
                        <!-- NOTE: untuk nama siswa dan kelas karena ditablenya pake id, nanti kalo udah dinamis kita konversi ke nama dan kelasnya -->
                        <th class="px-4 py-3">Nama Siswa</th>
                        <th class="px-4 py-3">Kelas Siswa</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Waktu Masuk</th>
                        <th class="px-4 py-3">Waktu Keluar</th>
                        <th class="px-4 py-3">Status Kehadiran</th>
                        <th class="px-4 py-3">Photo</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @if(isset($students) && $students->count())
                        @foreach($students as $student)
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $student->name }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    @if($student->classes->count())
                                        {{ $student->classes->pluck('name')->join(', ') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">-</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">-</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">-</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-3 py-1 text-xs font-medium rounded bg-slate-600">-</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="w-12 h-12 rounded-md bg-slate-700 flex items-center justify-center text-slate-400">No</div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <!-- data dummy buat debug doang -->
                        @for($i=1;$i<=5;$i++)
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-4 py-3 text-slate-200 text-sm">siswa{{ $i }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">12 SIJA {{ ceil($i/2) }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ now()->subDays($i)->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">07:0{{ $i }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">15:0{{ $i }}</td>
                                <td class="px-4 py-3"><span class="inline-block px-3 py-1 text-xs font-medium rounded bg-green-600">Present</span></td>
                                <td class="px-4 py-3">
                                    <img src="https://via.placeholder.com/48x48.png?text=Photo" alt="photo" class="w-12 h-12 rounded-md object-cover border border-slate-700">
                                </td>
                            </tr>
                        @endfor
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between text-slate-400 text-sm">
            <div>Showing <span class="text-white">1</span> to <span class="text-white">10</span> of <span class="text-white">100</span> entries</div>
            @if(isset($attendances) && method_exists($attendances, 'links'))
                <div class="text-sm">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

