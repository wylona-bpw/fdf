<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mouvement des Femmes de Foi — AMFDF')</title>
    <meta name="description" content="@yield('description', 'Association humanitaire a but non lucratif. Avec la foi, tout est possible.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col" x-data="{ mobileMenu: false }">

    @include('components.header')

    <main class="flex-1">
        @include('components.flash-messages')
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
