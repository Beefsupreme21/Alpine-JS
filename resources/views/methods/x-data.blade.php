<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="my-5">
            <h1 class="text-center text-3xl font-bold">x-data</h1>
        </div>
        <div class="text-center text-lg mt-5 mb-16">
            <h2>Everything in Alpine starts with the x-data directive.</h2>
        </div>

        <div class="my-5">
            If you want to create an Alpine component, but you don't need any data, you can pass in an empty object.
        </div>
        <script type="text/plain" class="language-markup max-w-[640px]">
            <div x-data="{}">
        </script>
        <script type="text/plain" class="language-markup max-w-[640px]">
            <div x-data>
        </script>
        <hr class="my-12">

        <div class="my-5">
            If you don't have much data, you can store it directly in the component
        </div>
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
        <hr class="my-12">


        <div class="my-5">
            If you have too much data to store, you can extract the x-data object to a component using Alpine.data
        </div>
        <script type="text/plain" class="language-markup max-w-[640px]">
            <div x-data="dropdown">
                <button @click="toggle">Toggle Content</button>
             
                <div x-show="open">
                    Content...
                </div>
            </div>
        </script>
        <script type="text/plain" class="language-markup max-w-[640px]">
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
</x-layout>
