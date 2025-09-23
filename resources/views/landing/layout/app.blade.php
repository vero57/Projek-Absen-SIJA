<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- Header --}}
        @include("landing.partials.head")

        {{-- Additional Style --}}
        @stack("style")
    </head>
    <body class="relative w-full overflow-x-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
        {{-- Navbar --}}

        <main class="relative flex w-full flex-col font-plusJakartaSans">
            {{-- Main Content --}}
            @yield("content")
        </main>

        {{-- Footer --}}
        @include('landing.partials.footer')

        {{-- Script --}}
        <!-- @include("landing.partials.script") -->

        {{-- Additional Script --}}
        @stack("script")
    </body>
</html>
