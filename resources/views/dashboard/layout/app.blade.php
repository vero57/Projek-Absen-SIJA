<!DOCTYPE html>
<html lang="id" class="h-full">
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
    </style>
    @stack('head')
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 font-sans">
    <div class="flex h-full min-h-screen">
        {{-- Sidebar Overlay for mobile --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden" onclick="toggleSidebar(false)"></div>
        {{-- Sidebar --}}
        <div id="sidebar" class="fixed md:static z-50 md:z-auto top-0 left-0 h-full w-64 bg-slate-800/50 backdrop-blur-sm border-r border-slate-700 flex flex-col transition-transform duration-300 -translate-x-full md:translate-x-0">
            @include('dashboard.partials.sidebar')
        </div>
        <div class="flex-1 flex flex-col min-h-screen">
            @include('dashboard.partials.navbar')
            <main class="flex-1 p-2 md:p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        function toggleSidebar(show) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (show) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
        // Close sidebar on resize to md and up
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 768) {
                toggleSidebar(false);
            }
        });
    </script>
    @stack('scripts')
</body>
</html>