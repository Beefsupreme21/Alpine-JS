<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="mb-16">
            <h1 class="text-4xl font-bold my-5">x-for</h1>
            <h2 class="text-xl mt-5 mb-5">Basically a foreach loop for Alpine data</h2>
            <ul class="list-disc pl-6">
                <li>x-for MUST be declared on a template element</li>
                <li>That template element MUST have only one root element</li>
            </ul>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 1</p>
            </div>
            <div x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
                <template x-for="color in colors">
                    <li x-text="color"></li>
                </template>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
                    <template x-for="color in colors">
                        <li x-text="color"></li>
                    </template>
                </div>
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 2</p>
            </div>
            <p>You can access data within an objec by using dot notation</p>
            <div x-data="{ colors: [{id: 1, name: 'Red'}, {id: 2, name: 'Orange'}] }">
                <template x-for="color in colors">
                    <div>
                        <span x-text="color.id"></span>
                        <span x-text="color.name"></span>
                    </div>
                </template>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ colors: [{id: 1, name: 'Red'}, {id: 2, name: 'Orange'}] }">
                    <template x-for="color in colors">
                        <div>
                            <span x-text="color.id"></span>
                            <span x-text="color.name"></span>
                        </div>
                    </template>
                </div>                  
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Looping a specific number of times</p>
            </div>
            <p class="mb-4">Here we got 10 numbers but are only looping through 5 of them</p>
            <div x-data="{ numbers: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'] }">
                <template x-for="number in 5">
                    <span x-text="number"></span>
                </template>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ numbers: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'] }">
                    <template x-for="number in 5">
                        <span x-text="number"></span>
                    </template>
                </div>                  
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Keys</p>
            </div>
            <p class="mb-5">You'll need to specify a key for each iteration if you're going to be re-ordering the items.</p>
            <ul x-data="{ colors: [
                { id: 1, label: 'Red' },
                { id: 2, label: 'Orange' },
                { id: 3, label: 'Yellow' },
            ]}">
                <template x-for="color in colors" :key="color.id">
                    <li x-text="color.label"></li>
                </template>
            </ul>

            <script type="text/plain" class="language-markup max-w-[640px]">
                <ul x-data="{ colors: [
                    { id: 1, label: 'Red' },
                    { id: 2, label: 'Orange' },
                    { id: 3, label: 'Yellow' },
                ]}">
                    <template x-for="color in colors" :key="color.id">
                        <li x-text="color.label"></li>
                    </template>
                </ul>
            </script>
        </div>
    </div>
</x-layout>
