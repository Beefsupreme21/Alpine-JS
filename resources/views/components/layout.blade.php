<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Alpine-JS</title>
        <link rel = "icon" href="{{ asset('images/alpinejs.svg') }}" type = "image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <link rel="stylesheet" href="{{ asset('prism.css') }}">
        <link rel="stylesheet" href="{{ asset('style.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    </head>

    <main x-data="{ open: false }">
        <header>
            <x-mobile-nav />   
            <x-desktop-nav />   
        </header>

        <div class="flex flex-1 flex-col bg-[#171923] md:pl-64">
            <x-mobile-nav-toggle />   
            <main class="max-w-screen-lg min-h-screen sm:px-16 md:px-24">
                {{ $slot }}
            </main>
        </div>

        <script src="{{ asset('prism.js') }}"></script>
        <script>Prism.highlightAll();</script>
    </main>
</html>