<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-effect</h1>
            <h2 class="text-xl mt-5 mb-16">Execute a script each time one of its dependancies change</h2>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Transition helper</p>
            </div>
            <p>By default, the duration is set to be 150 milliseconds when entering, and 75 milliseconds when leaving.</p>
            <div x-data="{ open: false }" class="my-5">
                <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Toggle
                </button>
                <span x-show="open" x-transition>
                    Hello
                </span>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <span x-show="open" x-transition>Hello</span>
            </script>
        </div>
    </div>
</x-layout>
