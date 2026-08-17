<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mouvement des Femmes de Foi — AMFDF')</title>
    <meta name="description" content="@yield('description', setting('site_description', 'Association humanitaire a but non lucratif. Avec la foi, tout est possible.'))">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / réseaux sociaux -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AMFDF — Mouvement des Femmes de Foi">
    <meta property="og:title" content="@yield('title', 'Mouvement des Femmes de Foi — AMFDF')">
    <meta property="og:description" content="@yield('description', setting('site_description', 'Association humanitaire a but non lucratif. Avec la foi, tout est possible.'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo-amfdf-512.png') }}">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Mouvement des Femmes de Foi — AMFDF')">
    <meta name="twitter:description" content="@yield('description', setting('site_description', 'Association humanitaire a but non lucratif. Avec la foi, tout est possible.'))">
    <meta name="twitter:image" content="{{ asset('images/logo-amfdf-512.png') }}">

    <link rel="preload" href="{{ asset('fonts/dm-sans-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/playfair-display-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('images/logo-amfdf-128.png') }}">

    {{-- Données structurées — organisation caritative (SEO / rich results) --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'NGO',
        'name' => 'Mouvement des Femmes de Foi',
        'alternateName' => 'AMFDF',
        'url' => url('/'),
        'logo' => asset('images/logo-amfdf-512.png'),
        'description' => setting('site_description'),
        'email' => setting('email'),
        'telephone' => setting('phone'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => "31 boulevard d'Alembert",
            'postalCode' => '78280',
            'addressLocality' => 'Guyancourt',
            'addressCountry' => 'FR',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col" x-data="{ mobileMenu: false }">

    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100]
              focus:px-4 focus:py-2 focus:rounded-lg focus:bg-brand-gold focus:text-brand-blue-dk focus:font-semibold">
        Aller au contenu
    </a>

    @include('components.header')
    <main id="main-content" class="flex-1">
        @include('components.flash-messages')
        @yield('content')
    </main>

    @include('components.footer')
    <x-back-to-top />
</body>
</html>
