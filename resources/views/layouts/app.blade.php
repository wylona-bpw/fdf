<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mouvement des Femmes de Foi — AMFDF')</title>
    <meta name="description" content="@yield('description', 'Association humanitaire a but non lucratif. Avec la foi, tout est possible.')">
    <!-- Open Graph -->
    <meta property="og:image" content="{{ asset('images/logo-amfdf-512.png') }}">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('images/logo-amfdf-128.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col" x-data="{ mobileMenu: false }">

    @include('components.header')
    <main class="flex-1">
        @include('components.flash-messages')
        @yield('content')
    </main>

    @include('components.footer')
    <x-back-to-top />
</body>
</html>
