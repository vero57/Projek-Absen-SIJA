<div class="flex justify-between mb-6">
    <!-- Home Icon -->
    <a href="{{ route('landing.home') }}" class="glass-effect rounded-full p-3 cursor-pointer hover:bg-white/10 transition-all duration-300">
        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-8l2 2m-2-2v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
        </svg>
    </a>

    <!-- User/Profile Section -->
    @if(auth()->check())
        <div class="relative flex items-center space-x-2 group" id="profileDropdown">
            <!-- User Icon jika sudah login -->
            <button type="button" id="profileButton" class="glass-effect rounded-full p-3 cursor-pointer hover:bg-white/10 transition-all duration-300 focus:outline-none">
                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownMenu" class="absolute right-0 top-12 min-w-[120px] bg-slate-800/90 rounded-lg shadow-lg py-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 z-50">
                <a href="{{ route('landing.profile') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-slate-700 transition">Profile</a>
                <form action="{{ route('auth.logoutsiswa') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-slate-200 hover:bg-slate-700 transition">Logout</button>
                </form>
            </div>
        </div>
    @else
        <!-- Tombol Login dan Register jika belum login -->
        <div class="flex space-x-2 items-center">
            <a href="{{ route('auth.login-register') }}" class="glass-effect px-3 py-1 rounded-lg text-slate-200 font-normal text-sm hover:bg-white/10 transition-all duration-300">Login</a>
            <a href="{{ route('auth.login-register', ['panel' => 'register']) }}" class="glass-effect px-3 py-1 rounded-lg text-slate-200 font-normal text-sm hover:bg-white/10 transition-all duration-300">Register</a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileButton = document.getElementById('profileButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const profileDropdown = document.getElementById('profileDropdown');

    if (profileButton && dropdownMenu) {
        // Toggle dropdown saat diklik
        profileButton.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('opacity-0');
            dropdownMenu.classList.toggle('pointer-events-none');
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!profileDropdown.contains(e.target)) {
                dropdownMenu.classList.add('opacity-0');
                dropdownMenu.classList.add('pointer-events-none');
            }
        });

        // Prevent dropdown tertutup saat klik di dalam dropdown
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});
</script>
