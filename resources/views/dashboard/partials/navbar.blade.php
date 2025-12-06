<header class="bg-slate-800/30 backdrop-blur-sm border-b border-slate-700 p-4 md:p-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            {{-- Sidebar toggle button (mobile only) --}}
            <button class="md:hidden mr-3 text-white focus:outline-none" onclick="toggleSidebar(true)">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h2 id="pageTitle" class="text-xl md:text-2xl font-semibold text-white">Dashboard</h2>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-slate-300 flex items-center">
                <i class="fas fa-bell mr-2"></i>
                @if(auth()->check())
                    <span class="text-sm">
                        Selamat Datang, <span class="text-white font-semibold">{{ auth()->user()->name }}</span>!
                    </span>
                    <span class="ml-2 text-slate-400 text-xs">
                        ({{ auth()->user()->role ? auth()->user()->role->name : '-' }})
                    </span>
                @endif
            </div>
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
        </div>
    </div>
</header>
