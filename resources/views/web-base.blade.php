<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantDrop | @yield('title','Welcome')</title>
    <link rel="icon" href="{{asset('Plantdrop-Leaf.png')}}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
        :root {
            background-color: #111810 !important;
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<header>
    @auth
        <x-navbar></x-navbar>
    @endauth
</header>
<body>
@yield('content')
@stack('scripts')
</body>
</html>
