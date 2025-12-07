@extends("landing.layout.app",
    [
        "title" => "Absen SIJA",
    ]
)

@push("style")
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }

    .glass-effect {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .feature-card {
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.08);
    }

    .clock-glow {
      text-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
    }

    .styled-table th {
      font-weight: 600;
      color: #cbd5e1; /* slate-300 */
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 0.05em;
    }

    .styled-table td {
      color: #e2e8f0; /* slate-200 */
      font-size: 0.9rem;
    }
  </style>
@endpush

@section("content")
<section class="min-h-screen text-slate-200">
  <div class="container mx-auto px-6 py-8">
    @include("landing.partials.header")
    <div class="text-center mb-12">
    <h1 class="text-3xl font-bold text-slate-100 mb-2">
        @if ($userName)
            Selamat datang, {{ $userName }}
        @else
            Selamat datang di Absen SIJA
        @endif
    </h1>
      <p class="text-slate-400">Kelola kehadiran Anda dengan mudah, jangan lupa untuk selalu Absen ya</p>
    </div>
    <!-- Clock Section -->
    <div class="text-center mb-16">
      <div class="glass-effect rounded-2xl p-8 max-w-md mx-auto">
        <div class="text-slate-400 text-sm mb-2">Waktu Sekarang</div>
        <div id="clock" class="text-5xl font-bold text-indigo-300 clock-glow mb-2">00:00:00</div>
        <div id="date" class="text-slate-400 text-sm"></div>
      </div>
    </div>

    <!-- Feature Cards -->
    @if(auth()->check() && (auth()->user()->role->name === 'Admin' || auth()->user()->role->name === 'Guru'))
    <div class="flex justify-center items-center min-h-[200px]">
        <a href="{{ route('dashboard.dash') }}">
          <div class="feature-card glass-effect rounded-xl p-6 text-center cursor-pointer mx-auto" style="max-width:350px;">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 10h2l1 10h12l1-10h2M9 21V10m6 11V10M9 10V7a3 3 0 016 0v3" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-100 mb-2">Kembali ke Dashboard</h3>
            <p class="text-slate-400 text-sm">Menuju halaman dashboard Admin/Guru</p>
          </div>
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto justify-center">
        <!-- Card fitur siswa -->
        <a href="{{ route("feature.absen") }}">
          <div class="feature-card glass-effect rounded-xl p-6 text-center cursor-pointer">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-100 mb-2">Absen Muka</h3>
            <p class="text-slate-400 text-sm">Lakukan absensi dengan foto wajah untuk verifikasi kehadiran</p>
          </div>
        </a>

        <a href="{{ route("feature.izin") }}">
          <div class="feature-card glass-effect rounded-xl p-6 text-center cursor-pointer">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-100 mb-2">Pengajuan Izin</h3>
            <p class="text-slate-400 text-sm">Ajukan permohonan izin atau cuti dengan mudah dan cepat</p>
          </div>
        </a>

        <a href="{{ route("feature.jurnal") }}">
          <div class="feature-card glass-effect rounded-xl p-6 text-center cursor-pointer">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-100 mb-2">Pengisian Jurnal</h3>
            <p class="text-slate-400 text-sm">Catat aktivitas harian dan laporan kerja Anda</p>
          </div>
        </a>
    </div>
    @endif

    @if(!(auth()->check() && (auth()->user()->role->name === 'Admin' || auth()->user()->role->name === 'Guru')))
    <!-- Section Tabel Absensi -->
    <div class="mt-16 max-w-5xl mx-auto">
      <!-- Tab Header -->
      <div class="flex justify-center space-x-6 mb-6">
        <button class="tab-btn px-6 py-2 rounded-lg font-medium text-slate-300" data-tab="absen">Absen</button>
        <button class="tab-btn px-6 py-2 rounded-lg font-medium text-slate-300" data-tab="izin">Izin</button>
        <button class="tab-btn px-6 py-2 rounded-lg font-medium text-slate-300" data-tab="jurnal">Jurnal</button>
      </div>

      <!-- Table Container -->
      <div class="glass-effect rounded-xl p-6 overflow-x-auto">
        @if(!auth()->check())
          <div class="text-center text-slate-400 py-12">
            <strong>Silahkan login terlebih dahulu</strong>
          </div>
        @else
          <table id="table-absen" class="styled-table w-full text-left border-collapse">
            <thead class="bg-slate-800/50">
              <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Jam Masuk</th>
                <th class="px-4 py-3">Jam Pulang</th>
              </tr>
            </thead>
            <tbody>
              <tr class="hover:bg-white/5">
                <td class="px-4 py-3">Budi Santoso</td>
                <td class="px-4 py-3">12 September 2025</td>
                <td class="px-4 py-3">08:00</td>
                <td class="px-4 py-3">16:00</td>
              </tr>
              <tr class="hover:bg-white/5">
                <td class="px-4 py-3">Siti Aminah</td>
                <td class="px-4 py-3">12 September 2025</td>
                <td class="px-4 py-3">08:10</td>
                <td class="px-4 py-3">16:05</td>
              </tr>
            </tbody>
          </table>

          <table id="table-izin" class="styled-table w-full text-left border-collapse hidden">
            <thead class="bg-slate-800/50">
              <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Jenis Izin</th>
                <th class="px-4 py-3">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr class="hover:bg-white/5">
                <td class="px-4 py-3">Andi Wijaya</td>
                <td class="px-4 py-3">11 September 2025</td>
                <td class="px-4 py-3">Sakit</td>
                <td class="px-4 py-3">Demam</td>
              </tr>
              <tr class="hover:bg-white/5">
                <td class="px-4 py-3">Dewi Lestari</td>
                <td class="px-4 py-3">10 September 2025</td>
                <td class="px-4 py-3">Cuti</td>
                <td class="px-4 py-3">Acara keluarga</td>
              </tr>
            </tbody>
          </table>

          <table id="table-jurnal" class="styled-table w-full text-left border-collapse hidden">
            <thead class="bg-slate-800/50">
              <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Aktivitas</th>
              </tr>
            </thead>
            <tbody>
              <tr class="hover:bg-white/5">
                <td class="px-4 py-3">Rudi Hartono</td>
                <td class="px-4 py-3">12 September 2025</td>
                <td class="px-4 py-3">Mengerjakan laporan bulanan</td>
              </tr>
              <tr class="hover:bg-white/5">
                <td class="px-4 py-3">Ani Puspitasari</td>
                <td class="px-4 py-3">12 September 2025</td>
                <td class="px-4 py-3">Membuat desain presentasi</td>
              </tr>
            </tbody>
          </table>
        @endif
      </div>
    </div>
    @endif
  </div>
</section>
@endsection

@push("script")
  <script>
    // Clock
    function updateClock() {
      const now = new Date();
      document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID', { hour12: false });
      document.getElementById('date').textContent = now.toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Tab Switching
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabTables = {
      absen: document.getElementById('table-absen'),
      izin: document.getElementById('table-izin'),
      jurnal: document.getElementById('table-jurnal')
    };

    tabButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        Object.values(tabTables).forEach(t => t.classList.add('hidden'));
        tabButtons.forEach(b => b.classList.remove('bg-indigo-500/20', 'text-indigo-300'));

        const target = btn.getAttribute('data-tab');
        tabTables[target].classList.remove('hidden');
        btn.classList.add('bg-indigo-500/20', 'text-indigo-300');
      });
    });
    tabButtons[0].click();

    // User Profile
    document.getElementById('btn-profile').addEventListener('click', () => {
      alert('Profil Pengguna\n\nFitur ini akan menampilkan informasi profil dan pengaturan akun Anda.');
    });
  </script>
@endpush
