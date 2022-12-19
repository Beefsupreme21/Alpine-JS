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
    </head>

    <main x-data="{ open: false }">
        <header>
            <x-mobile-nav />   
            <x-desktop-nav />   
        </header>

        <div class="flex flex-1 flex-col md:pl-64">
            <div class="sticky top-0 z-10 bg-gray-100 pl-1 pt-1 sm:pl-3 sm:pt-3 md:hidden">
              <button x-on:click="open = ! open" type="button" class="-ml-0.5 -mt-0.5 inline-flex h-12 w-12 items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
              </button>
            </div>
            <main class="flex-1 bg-[#171923]">
                <div class="max-w-screen-lg min-h-screen sm:px-16 md:px-24">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <script src="{{ asset('prism.js') }}"></script>
        <script>Prism.highlightAll();</script>
    </main>
</html>