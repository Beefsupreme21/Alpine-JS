<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-on</h1>
            <h2 class="text-xl mt-5 mb-16">x-on is used to bind event listeners to elements. You can use it to listen for a click, input, submit, focus, blur, etc.</h2>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">x-on:click or @click</p>
            </div>
            <p>Listing for a click is pretty straightforward.</p>
            <div x-data="{ open: false }" class="my-5">
                <button x-on:click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Toggle
                </button>
                <span x-show="open" x-transition x-cloak>
                    Hello
                </span>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false }" class="my-5">
                    <button x-on:click="open = !open">
                        Toggle
                    </button>
                    <span x-show="open" x-transition>
                        Hello
                    </span>
                </div>
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 2</p>
            </div>
            <p>Running a function</p>
            <div x-data class="my-5">
                <button x-on:click="alert('Hello World!')">
                    Say Hi
                </button>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data>
                    <button x-on:click="function('Hello World!')">
                        Say Hi
                    </button>
                </div>
            </script>
        </div>
    </div>
</x-layout>
