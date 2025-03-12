<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $landing = Cache::remember('landing', now()->addHour(), fn() => \App\Models\LandingPage::select('hero')->first());
    $tagline = $landing?->hero['title'] ?? '';
@endphp

<head>
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    @include('partials.meta', ['landing' => $landing, 'tagline' => $tagline])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" >
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.tsx'])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
