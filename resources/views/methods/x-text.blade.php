<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-text</h1>
            <h2 class="text-xl mt-5 mb-16">x-text sets the text content of an element to the result of a given expression.</h2>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">x-text</p>
            </div>
            <p>x-text sets the text content of an element to the result of a given expression.</p>
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 1</p>
            </div>
            <div x-data="{ message: 'Hello, World!' }">
                <div class="text-xl" x-text="message"></div>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ message: 'Hello, World!' }">
                    <div class="text-xl font-bold" x-text="message"></div>
                </div>
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 2</p>
            </div>
            <div x-data="{}">
                <div>
                    Copyright ©
                    <span x-text="new Date().getFullYear()"></span>
                </div>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{}">
                    <div>
                        Copyright ©
                        <span x-text="new Date().getFullYear()"></span>
                    </div>
                </div>
            </script>
        </div>

    </div>
</x-layout>



