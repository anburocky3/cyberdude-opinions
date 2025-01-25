<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 flex flex-col min-h-screen">

    <livewire:layout.header />

    @if (session('status'))
        <div class="container mx-auto mt-5">
            <livewire:components.alert type="success" message="{{ session('status') }}" />
        </div>
    @endif

    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <livewire:layout.footer />
</body>
</html>
