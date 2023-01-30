<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Basic Model</p>
            </div>
            <p>showModal is false by default</p>
            <p>Click to the buttton to turn it to true</p>

            <div x-data="{ showModal: false }">
                <button x-on:click="showModal = true">Open Modal</button>
                <div x-show="showModal" x-on:click.away="showModal = false" x-cloak>
                    <div class="fixed inset-0 z-50 flex justify-center items-center px-4 py-8 bg-gray-900 bg-opacity-75">
                        <div x-on:click.away="showModal = false" class="relative max-w-md rounded-lg shadow-xl">
                            <div class="rounded-lg shadow-lg overflow-hidden">
                                <div class="bg-white p-4">
                                    <p class="text-lg font-bold text-gray-800 mb-4">Model Text</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/plain" class="language-markup max-w-[680px]">
                <div x-data="{ showModal: false }">
                    <button @click="showModal = true">
                        Open Modal
                    </button>
                    <div x-show="showModal" @click.away="showModal = false" x-cloak>
                        <div class="fixed inset-0 z-50 flex justify-center 
                        items-center bg-gray-900 bg-opacity-75">
                            <div @click.away="showModal = false" 
                                class="relative max-w-md rounded-lg shadow-xl">
                                <div class="rounded-lg shadow-lg overflow-hidden">
                                    <div class="bg-white p-4">
                                        <p class="text-lg font-bold mb-4">
                                            Model Text
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>
</x-layout>
