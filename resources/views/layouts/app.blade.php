<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    @yield('head')

    <x-meta-tags
        title="@yield('meta-title', config('app.name'))"
        description="@yield('meta-description', 'CyberDude Tutorial forum is a place to submit your suggestions and vote on ideas from the community.')"
        url="{{ url()->current() }}"
        image="@yield('meta-image', asset('img/cyberdude-tutorials.png'))"
    />

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
