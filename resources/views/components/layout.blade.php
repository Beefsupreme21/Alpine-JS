<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Alpine-JS</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <link rel="stylesheet" href="{{ asset('prism.css') }}">
        <link rel="stylesheet" href="{{ asset('style.css') }}">

    </head>

    <main>
        <header>
            <x-navbar />   
        </header>
        <body class="bg-gray-700">
            {{ $slot }}
        </body>
        <script src="{{ asset('prism.js') }}"></script>
        <script>
            Prism.highlightAll();
        </script>
    </main>
</html>