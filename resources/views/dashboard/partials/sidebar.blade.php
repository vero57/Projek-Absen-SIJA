<div class="h-full flex flex-col">
    {{-- Close button for mobile --}}
    <div class="md:hidden flex justify-end p-2">
        <button onclick="toggleSidebar(false)" class="text-slate-300 hover:text-white">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    <div class="p-4 md:p-6 border-b border-slate-700 flex flex-row justify-between h-[80.7px]">
        <h1 class="text-lg md:text-xl font-bold text-white flex items-center sidebar-label">
            <i class="fas fa-chart-line mr-2 md:mr-3 text-blue-400"></i>
            Dashboard
        </h1>
        <button onclick="toggleSidebarDesktop()" class="text-slate-300 hover:text-white focus:outline-none" id="desktopToggleBtn">
            <i class="fas fa-chevron-left text-lg"></i>
        </button>
    </div>

    <nav class="flex-1 p-2 md:p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard.dash') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.dash') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-home mr-3 text-blue-400"></i>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </li>
            @if(auth()->check() && auth()->user()->role && auth()->user()->role->name === 'Admin')
            <li>
                <a href="{{ route('dashboard.users.index') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.users.*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-users mr-3 text-green-400"></i>
                    <span class="sidebar-label">Users</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('dashboard.siswa') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.siswa*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-user-graduate mr-3 text-blue-400"></i>
                    <span class="sidebar-label">Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.subjects.index') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.subjects*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-book mr-3 text-green-400"></i>
                    <span class="sidebar-label">Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.absensi') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.absensi*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-users mr-3 text-green-400"></i>
                    <span class="sidebar-label">Presensi Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.jurnal') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.jurnal*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-book-open mr-3 text-purple-400"></i>
                    <span class="sidebar-label">Jurnal Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.pelanggaran') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.pelanggaran*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-exclamation-triangle mr-3 text-red-400"></i>
                    <span class="sidebar-label">Pelanggaran Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.izin') }}" class="menu-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard.izin*') ? 'active text-white' : 'text-slate-300' }}">
                    <i class="fas fa-file-text mr-3 text-gray-400"></i>
                    <span class="sidebar-label">Izin Siswa</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-2 md:p-4 border-t border-slate-700">
        <form method="POST" action="{{ route('logout.dash') }}">
            @csrf
            <button type="submit" class="menu-item flex items-center px-4 py-3 text-slate-300 rounded-lg hover:text-white w-full text-left hover:bg-red-500/20">
                <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
                <span class="sidebar-label">Logout</span>
            </button>
        </form>
    </div>
</div>

@push('scripts')
    <script>

    </script>
@endpush
