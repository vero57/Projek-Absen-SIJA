@extends(
    "dashboard.layout.app",
    [
        "title" => "Presensi Siswa",
    ]
)

@section('content')
<div class="content-section">
    <div class="bg-slate-800/50 flex flex-row items-center justify-between backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <div class="flex items-center gap-4">
            <i class="fas fa-users text-4xl text-green-400"></i>
            <div>
                <h3 class="text-2xl font-semibold text-white">Presensi Siswa</h3>
                <p class="text-slate-400">Daftar rekaman kehadiran siswa — tanggal, jam, status, dan lokasi.</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ route('dashboard.absensi.exportPdf') }}" class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded text-sm">Ekspor Data</a>
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
                        <th class="px-4 py-3">Nama Siswa</th>
                        <th class="px-4 py-3">Kelas Siswa</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Waktu Masuk</th>
                        <th class="px-4 py-3">Waktu Keluar</th>
                        <th class="px-4 py-3">Status Kehadiran</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @if(isset($attendances) && $attendances->count())
                        @foreach($attendances as $attendance)
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    {{ $attendance->student->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    {{ $attendance->student && $attendance->student->classes->count() ? $attendance->student->classes->pluck('name')->join(', ') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $attendance->date }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $attendance->time_in ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-200 text-sm">{{ $attendance->time_out ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-3 py-1 text-xs font-medium rounded bg-slate-600">
                                        {{ $attendance->status->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    @if($attendance->photo)
                                        <img src="{{ asset($attendance->photo) }}" alt="photo" class="w-12 h-12 rounded-md object-cover border border-slate-700 cursor-pointer preview-photo" data-photo="{{ asset($attendance->photo) }}">
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-200 text-sm">
                                    <a href="{{ route('dashboard.absensi.show', $attendance->id) }}" class="inline-block bg-blue-500 hover:bg-blue-400 text-white px-3 py-1 rounded text-xs font-semibold mr-2">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center text-slate-400 py-6">Tidak ada data presensi.</td>
                        </tr>
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

<!-- Modal Preview Gambar -->
<div id="photoModal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100vw; height:100vh; background:rgba(30,41,59,0.85); align-items:center; justify-content:center;">
    <div style="position:relative; max-width:90vw; max-height:90vh; display:flex; align-items:center; justify-content:center;">
        <img id="modalImg" src="" alt="Preview" style="max-width:90vw; max-height:80vh; border-radius:1rem; box-shadow:0 8px 32px rgba(0,0,0,0.25); background:#222;">
        <button id="closeModalBtn" type="button" style="position:absolute; top:-18px; right:-18px; background:#f87171; color:white; border:none; border-radius:50%; width:36px; height:36px; font-size:1.5rem; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,0.18);">×</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    // Open modal on photo click
    document.querySelectorAll('.preview-photo').forEach(function(img) {
        img.addEventListener('click', function(e) {
            e.stopPropagation();
            var modal = document.getElementById('photoModal');
            var modalImg = document.getElementById('modalImg');
            modalImg.src = this.dataset.photo;
            modal.style.display = 'flex';
        });
    });
    // Close modal
    document.getElementById('closeModalBtn').onclick = function(e) {
        e.stopPropagation();
        document.getElementById('photoModal').style.display = 'none';
        document.getElementById('modalImg').src = '';
    };
    // Close modal on outside click
    document.getElementById('photoModal').onclick = function(e) {
        if (e.target === this) {
            this.style.display = 'none';
            document.getElementById('modalImg').src = '';
        }
    };
})();
</script>
@endpush

