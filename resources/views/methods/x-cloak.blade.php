<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="mb-16">
            <h1 class="text-4xl font-bold my-5">x-cloak</h1>
            <h2 class="text-xl mt-5">Hide a block of HTML until after Alpine is finished initializing its contents. Refresh the page to see the example</h2>
        </div>

        <div class="my-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2">
                <p class="text-xl">CSS Requirements</p>
            </div>
            <p>For x-cloak to work you need to put this in the CSS file</p>
            <script type="text/plain" class="language-css max-w-[640px]">
                [x-cloak] { display: none !important; }
            </script>
        </div>

        <div class="my-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2">
                <p class="text-xl">With x-cloak</p>
            </div>
            <div x-data="{ open: false }" class="h-56">
                <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Toggle
                </button>
                <nav x-show="open" x-cloak class="bg-white text-black p-4">
                    <a href="#" class="block mt-4">Home</a>
                    <a href="#" class="block mt-4">About</a>
                    <a href="#" class="block mt-4">Contact</a>
                </nav>
            </div>
        </div>
        <div class="my-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2">
                <p class="text-xl">Without x-cloak</p>
            </div>
            <div x-data="{ open: false }" class="h-56">
                <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Toggle
                </button>
                <nav x-show="open" class="bg-white text-black p-4">
                    <a href="#" class="block mt-4">Home</a>
                    <a href="#" class="block mt-4">About</a>
                    <a href="#" class="block mt-4">Contact</a>
                </nav>
            </div>
        </div>


        <script type="text/plain" class="language-markup max-w-[640px]">
            <div x-data="{ open: false }">
                <button @click="open = !open">
                    Toggle
                </button>
                <nav x-show="open" x-cloak>
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                </nav>
            </div>
        </script>
    </div>
</x-layout>
