<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Blog App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if (!app()->environment('testing'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900 px-4">
        {{-- タイトル --}}
        <div class="w-full sm:max-w-md mb-6 text-center">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                Laravel Blog App
            </h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                ログイン
            </p>
        </div>

        <div class="w-full sm:max-w-md px-6 py-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
