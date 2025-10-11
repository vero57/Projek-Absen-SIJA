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
                <a href="#" class="menu-item active flex items-center px-4 py-3 text-white rounded-lg" onclick="setActiveMenu(this, 'dashboard')">
                    <i class="fas fa-home mr-3 text-blue-400"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="menu-item flex items-center px-4 py-3 text-slate-300 rounded-lg hover:text-white" onclick="setActiveMenu(this, 'menu1')">
                    <i class="fas fa-users mr-3 text-green-400"></i>
                    Menu1
                </a>
            </li>
            <li>
                <a href="#" class="menu-item flex items-center px-4 py-3 text-slate-300 rounded-lg hover:text-white" onclick="setActiveMenu(this, 'menu2')">
                    <i class="fas fa-cog mr-3 text-purple-400"></i>
                    Menu2
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-slate-700">
        <button class="menu-item flex items-center px-4 py-3 text-slate-300 rounded-lg hover:text-white w-full text-left hover:bg-red-500/20" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
            Logout
        </button>
    </div>
</div>


@push('scripts')
    <script>
        function setActiveMenu(element, menuName) {
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
                item.classList.remove('text-white');
                item.classList.add('text-slate-300');
            });
            element.classList.add('active');
            element.classList.add('text-white');
            element.classList.remove('text-slate-300');

            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
            });

            var el = document.getElementById(menuName + '-content');
            if (el) el.classList.remove('hidden');

            const titles = { 'dashboard': 'Dashboard', 'menu1': 'Menu1', 'menu2': 'Menu2' };
            document.getElementById('pageTitle').textContent = titles[menuName] || 'Dashboard';
        }

        function handleLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil! Anda akan diarahkan ke halaman login.');
            }
        }
    </script>
@endpush