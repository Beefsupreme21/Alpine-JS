<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="my-4">
            <p class="text-center text-3xl font-bold">x-show</p>
        </div>

        <div x-data="{ open: false }">
            <button x-on:click="open = ! open">Toggle Dropdown</button>
            <div x-show="open">
                Dropdown Contents...
            </div>
        </div>
        <hr>





    </div>
</x-layout>
