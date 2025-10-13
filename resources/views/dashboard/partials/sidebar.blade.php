<div class="w-64 bg-slate-800/50 backdrop-blur-sm border-r border-slate-700 flex flex-col">
    <div class="p-6 border-b border-slate-700">
        <h1 class="text-xl font-bold text-white flex items-center">
            <i class="fas fa-chart-line mr-3 text-blue-400"></i>
            Dashboard
        </h1>
    </div>

    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard.dash') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.dash') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-home mr-3 text-blue-400"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.absensi') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.absensi') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-users mr-3 text-green-400"></i>
                    Absensi Siswa
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.jurnal') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.jurnal') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-cog mr-3 text-purple-400"></i>
                    Jurnal Siswa
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-slate-700">
        <form method="POST" action="">
            @csrf
            <button type="submit" class="menu-item flex items-center px-4 py-3 text-slate-300 rounded-lg hover:text-white w-full text-left hover:bg-red-500/20">
                <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
                Logout
            </button>
        </form>
    </div>
</div>

@push('scripts')
    <script>

    </script>
@endpush