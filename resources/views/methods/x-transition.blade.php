<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-transition</h1>
            <h2 class="text-xl mt-5 mb-16">Transition an element in and out using CSS transitions</h2>
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


        <div>
        <div class="flex items-center my-5 -ml-6">
            <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
            <p class="text-xl">Customizing duration</p>
        </div>
        <p>This will transition for 500 milliseconds when entering, and 500 milliseconds when leaving.</p>
        <div x-data="{ open: false }" class="my-5">
            <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Toggle
            </button>
            <span x-show="open" x-transition.duration.500ms>
            Hello
            </span>
        </div>
        <script type="text/plain" class="language-markup max-w-[640px]">
            <span x-show="open" x-transition.duration.500ms>Hello</span>
        </script>
        </div>

        <div>
        <div class="flex items-center my-5 -ml-6">
            <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
            <p class="text-xl">Customizing duration</p>
        </div>
        <p>This will.</p>
        <div x-data="{ open: false }" class="my-4">
            <button x-on:click="open = ! open">Open/Close</button>
            <div x-show="open"
            x-transition:enter.duration.200ms
            x-transition:leave.duration.1500ms>
            Content
            </div>
        </div>
        <script type="text/plain" class="language-markup max-w-[640px]">
            <div x-data="{ open: false }" class="my-4">
            <button x-on:click="open = ! open">Open/Close</button>
            <div x-show="open"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.1500ms>
                Content
            </div>
            </div>
        </script>
        </div>

        <div class="mt-10 mb-5">
        <div class="flex items-center mb-5 -ml-10">
            <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
            <p class="text-3xl">Using CSS classes to customize them</p>
        </div>
        <p class="my-5">The x-transition directive can take the following six arguments:</p>
        <ul class="my-6 text-lg">
            <li class="text-gray-400"><span class="font-bold text-white">enter: </span>When it is added to the DOM</li>
            <li class="text-gray-400"><span class="font-bold text-white">enter-start: </span>At the start of the enter transition</li>
            <li class="text-gray-400"><span class="font-bold text-white">enter-end: </span>At the end of the enter transition</li>
            <li class="text-gray-400"><span class="font-bold text-white">leave: </span>When it is removed from the DOM</li>
            <li class="text-gray-400"><span class="font-bold text-white">leave-start: </span>At the start of the leave transition</li>
            <li class="text-gray-400"><span class="font-bold text-white">leave-end: </span>At the end of the leave transition</li>
        </ul>
        </div>


        <div class="my-5 h-40">
        <div class="flex items-center my-5 -ml-6">
            <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
            <p class="text-xl">Example 2</p>
        </div>
        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Toggle
            </button>
            <div x-show="isOpen" 
            x-transition:enter="duration-300 transition-ease-in" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100"
            x-transition:leave="duration-300 transition-ease-in" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0">
                <h1>Modal Title</h1>
                <p>Modal content goes here</p>
            </div>
        </div>
        </div>

        <script type="text/plain" class="language-markup max-w-[640px]">
        <div x-data="{ isOpen: false }">
            <button x-on:click="isOpen = !isOpen">Open Modal</button>
            <div x-show="isOpen" 
                x-transition:enter="duration-300 transition-ease-in" 
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="duration-300 transition-ease-in" 
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0">
                <h1>Modal Title</h1>
                <p>Modal content goes here</p>
            </div>
        </div>
        </script>


        <div class="my-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 3</p>
            </div>
            <div x-data="{ open: false }" class="h-56">
                <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Toggle
                </button>
                <nav x-show="open" class="bg-gray-800 p-4"
                x-transition:enter="duration-300 ease-out" 
                x-transition:enter-start="opacity-0 transform -translate-x-full" 
                x-transition:enter-end="opacity-100 transform translate-x-0" 
                x-transition:leave="duration-200 ease-in" 
                x-transition:leave-start="opacity-100 transform translate-x-0" 
                x-transition:leave-end="opacity-0 transform -translate-x-full">
                    <a href="#" class="block mt-4">Home</a>
                    <a href="#" class="block mt-4">About</a>
                    <a href="#" class="block mt-4">Contact</a>
                </nav>
            </div>
        </div>

        <script type="text/plain" class="language-markup max-w-[640px]">
        <div x-data="{ open: false }">
            <button @click="open = !open" 
            class="bg-blue-500 font-bold py-2 px-4 rounded">
                Toggle Menu
            </button>
            <nav x-show="open" class="bg-gray-800 p-4"
            x-transition:enter="duration-300 ease-out" 
            x-transition:enter-start="opacity-0 transform -translate-x-full" 
            x-transition:enter-end="opacity-100 transform translate-x-0" 
            x-transition:leave="duration-200 ease-in" 
            x-transition:leave-start="opacity-100 transform translate-x-0" 
            x-transition:leave-end="opacity-0 transform -translate-x-full">
                <a href="#" class="block mt-4">Home</a>
                <a href="#" class="block mt-4">About</a>
                <a href="#" class="block mt-4">Contact</a>
            </nav>
        </div>
        </script>
    </div>
</x-layout>
