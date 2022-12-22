<x-layout>    
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-data</h1>
            <h2 class="text-xl mt-5 mb-16">Everything in Alpine starts with the x-data directive.</h2>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">x-data</p>
            </div>
            <p>x-data is a special attribute that allows you to bind data to the template of your HTML elements, allowing you to use that data in your JavaScript code and dynamically update the content or behavior of your page based on that data.</p>
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">x-data with no data</p>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{}">
            </script>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data>
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">x-data with minimal data</p>
            </div>
            <p>If you don't have much data, you can store it directly in the component</p>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false }">
            </script>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ message: 'Click me to change' }">
            </script>
            <script type="text/plain" class="language-javascript max-w-[640px]">
                <div x-data="{ change(){ this.message = 'Change message' } }>
            </script>
            <div class="my-5">
                To store multiple, you can simply use a comma
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false, message: 'Click me to change' }">
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">x-data with re-useable data</p>
            </div>
            <p>If you have too much data to store, you can extract the x-data object to a component using Alpine.data</p>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="dropdown">
                    <button @click="toggle">Toggle Content</button>
                 
                    <div x-show="open">
                        Content...
                    </div>
                </div>
            </script>
            <script type="text/plain" class="language-javascript max-w-[640px]">
                document.addEventListener('alpine:init', () => {
                    Alpine.data('dropdown', () => ({
                        open: false,
            
                        toggle() {
                            this.open = ! this.open
                        },
                    }))
                })
            </script>
        </div>
    </div>
</x-layout>
