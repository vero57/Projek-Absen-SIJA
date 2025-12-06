<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { box-sizing: border-box; }
        .menu-item { transition: all 0.3s ease; }
        .menu-item:hover { transform: translateX(4px); background: rgba(255, 255, 255, 0.1); }
        .menu-item.active { background: rgba(59, 130, 246, 0.2); border-right: 3px solid #3b82f6; }

        #sidebar {
            transition: margin-left 0.3s ease;
        }

        #sidebar.hidden {
            margin-left: -16rem;
        }

        /* width */
        ::-webkit-scrollbar {
        width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: lightgray;
        border-radius: 10px;
        }
    </style>
    @stack('head')
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 font-sans">
    <div class="flex h-full relative">
        <!-- Tombol buka sidebar (muncul saat sidebar tertutup) -->
        <button id="openSidebarBtn" class="hidden fixed left-0 top-4 z-40 p-3 bg-slate-800 text-blue-400 rounded-r-lg hover:bg-slate-700 transition-all">
            <i class="fas fa-arrow-right text-xl"></i>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="max-sm:absolute z-50">
            @include('dashboard.partials.sidebar')
        </div>

        <div class="flex-1 flex flex-col">
            @include('dashboard.partials.navbar')
            <main class="flex-1 p-2 md:p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const closeSidebarBtn = document.getElementById('CloseSidebar');
        const openSidebarBtn = document.getElementById('openSidebarBtn');

        // Tutup sidebar
        closeSidebarBtn.addEventListener('click', () => {
            sidebar.classList.add('hidden');
            openSidebarBtn.classList.remove('hidden');
            localStorage.setItem('sidebarState', 'closed');
        });

        // Buka sidebar
        openSidebarBtn.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
            openSidebarBtn.classList.add('hidden');
            localStorage.setItem('sidebarState', 'open');
        });

        // Load status sidebar dari localStorage
        window.addEventListener('load', () => {
            const sidebarState = localStorage.getItem('sidebarState') || 'open';
            if (sidebarState === 'closed') {
                sidebar.classList.add('hidden');
                openSidebarBtn.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
