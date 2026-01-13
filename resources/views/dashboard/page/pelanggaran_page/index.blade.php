@extends(
    "dashboard.layout.app",
    [
        "title" => "Pelanggaran Siswa",
    ]
)

@section('content')
    <div class="content-section">
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 mb-6 flex flex-row items-center justify-between">
            <div class="flex items-center gap-4">
                <i class="fas fa-exclamation-triangle text-4xl text-red-400"></i>
                <div>
                    <h3 class="text-2xl font-semibold text-white">Pelanggaran Siswa</h3>
                    <p class="text-slate-400">Daftar pelanggaran siswa — tanggal, jam, status, dan lokasi.</p>
                </div>
            </div>
            <div class="flex items-center">
                <a href="{{ route('dashboard.pelanggaran.exportPdf') }}" class="bg-red-600 hover:bg-red-500 text-white px-3 py-2 rounded text-sm">Ekspor Data</a>
            </div>
        </div>


        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
                <div class="flex items-center gap-2">
                    <!-- <button type="button" class="tab-btn px-3 py-1 rounded text-sm font-medium bg-slate-700 text-white" data-view="student">Siswa</button> -->
                    <!-- <button type="button" class="tab-btn px-3 py-1 rounded text-sm font-medium text-slate-300 hover:text-white" data-view="class">Kelas</button> -->
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <input type="search" placeholder="Cari nama siswa / pelajaran" class="flex-1 md:flex-none bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                    <button class="bg-red-600 hover:bg-red-500 text-white px-3 py-2 rounded text-sm">Search</button>
                </div>
            </div>

            <div class="overflow-x-auto -mx-4 px-4">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-left text-slate-300 text-sm uppercase tracking-wider">
                            <th class="px-4 py-3 w-12">No</th>
                            <th class="px-4 py-3 col-name w-64">Nama Siswa</th>
                            <th class="px-4 py-3 w-32">Kelas</th>
                            <th class="px-4 py-3 w-52">Ketentuan</th>
                            <th class="px-4 py-3 w-64">Deskripsi</th>
                            <th class="px-4 py-3">Hukuman</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-700">
                        @if(isset($violations) && $violations->count())
                            @foreach($violations as $idx => $j)
                                @php
                                    $no = (isset($violations) && method_exists($violations, 'firstItem')) ? $violations->firstItem() + $loop->index : $loop->iteration;
                                @endphp
                                <tr class="hover:bg-slate-800/40">
                                    <td class="px-4 py-3 text-slate-200 text-sm align-top">{{ $no }}</td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-purple-700 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($j->student_name ?? ($j->student_id ?? 'U'), 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="view-student text-slate-200 font-medium text-sm">{{ $j->student_name ?? ('ID: '.$j->student_id) }}</div>
                                                <div class="view-class text-slate-200 font-medium text-sm hidden">{{ $j->class_name ?? ($j->class_id ?? '-') }}</div>
                                                <div class="text-slate-400 text-xs">{{ $j->student_id ? 'ID: '.$j->student_id : '' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="font-medium">{{ $j->subject ?? '-' }}</div>
                                        <div class="text-slate-400 text-xs">{{ $j->submitted_at ? \Carbon\Carbon::parse($j->submitted_at)->format('Y-m-d H:i') : '' }}</div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-sm text-slate-200 line-clamp-2" title="{{ $j->description ?? '-' }}">
                                            {{ $j->description ?? '-' }}
                                        </div>
                                        @if(!empty($j->attachment))
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/'.$j->attachment) }}" target="_blank" class="text-xs text-sky-400 hover:underline">Lihat lampiran</a>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <a href="{{ route('dashboard.pelanggaran.show', $student->id) }}" class="inline-block bg-blue-500 hover:bg-blue-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <!-- dummy data -->
                            @for($i=1;$i<=6;$i++)
                                <tr class="hover:bg-slate-800/40">
                                    <td class="px-4 py-3 text-slate-200 text-sm align-top">{{ $i }}</td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-purple-700 flex items-center justify-center text-white font-semibold">
                                                {{ chr(64 + $i) }}
                                            </div>
                                            <div>
                                                <p class="view-student text-slate-200 font-medium text-sm" title="Siswa {{ $i }}">Siswa {{ $i }}</p>
                                                <!-- <p class="view-class text-slate-200 font-medium text-sm hidden">Kelas {{ ceil($i/2) }}</p> -->
                                                <p class="text-slate-400 text-xs" title="S00{{ $i }}">ID: S00{{ $i }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-slate-200 font-medium text-sm">Kelas {{ ceil($i/2) }}</div>
                                        <!-- <p class="text-slate-400 text-xs">{{ now()->subDays($i)->format('Y-m-d') }}</p> -->
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-sm text-slate-200 line-clamp-2" title="Deskripsi lengkap contoh jurnal">
                                            <!-- Contoh ringkasan jurnal untuk Siswa {{ $i }} tentang topik latihan dan hasil belajar pada pertemuan ini... -->
                                            <p>Melakukan ini</p>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-sm text-slate-200 line-clamp-2" title="Deskripsi lengkap contoh jurnal">
                                            <!-- Contoh ringkasan jurnal untuk Siswa {{ $i }} tentang topik latihan dan hasil belajar pada pertemuan ini... -->
                                            <p>Bro melakukan pelanggaran {{ $i }}</p>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <div class="text-sm text-slate-200 line-clamp-2" title="Deskripsi lengkap contoh jurnal">
                                            <!-- Contoh ringkasan jurnal untuk Siswa {{ $i }} tentang topik latihan dan hasil belajar pada pertemuan ini... -->
                                            <p>Surat Peringatan 1</p>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-200 text-sm">
                                        <a href="{{ route('dashboard.pelanggaran.show') }}" class="inline-block bg-blue-500 hover:bg-blue-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex items-center justify-between text-slate-400 text-sm">
                <div>Showing <span class="text-white">1</span> to <span class="text-white">10</span> entries</div>
                @if(isset($violations) && method_exists($violations, 'links'))
                    <div class="text-sm">
                        {{ $violations->links() }}
                    </div>
                @endif
            </div>
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
                b.classList.remove('text-slate-300', 'hover:text-white'); //
            } else {
                b.classList.remove('bg-slate-700','text-white');
                b.classList.add('text-slate-300', 'hover:text-white'); //
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
</script>
@endpush
