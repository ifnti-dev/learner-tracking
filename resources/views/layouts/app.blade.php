<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS du template (si tu as un fichier compilé) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    x-data="{
        page: 'blank',
        loaded: true,
        darkMode: localStorage.getItem('darkMode') === 'true',
        stickyMenu: false,
        sidebarToggle: false,
        scrollTop: false
    }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode') || 'false');
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))
    "
    :class="{ 'dark': darkMode }"
    class="bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden bg-white dark:bg-gray-900">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Content Area --}}
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            @include('layouts.navigation')

            <main>
                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
                    <div
                        class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-3 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-6">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- JS du template --}}
    <script src="{{ asset('js/index.js') }}"></script>
    @stack('scripts')
</body>

</html>