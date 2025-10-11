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
    <div class="flex h-full">
        @include('dashboard.partials.sidebar')

        <div class="flex-1 flex flex-col">
            @include('dashboard.partials.navbar')

            <main class="flex-1 p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
@stack('scripts')
</html>