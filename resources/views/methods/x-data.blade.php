<x-layout>
    <div class="w-4/5 mx-auto">
        <div class="my-4">
            <p class="text-center text-3xl font-bold">x-data</p>
        </div>


        <div x-data="{name: 'Name', message: 'Hello <b>World</b>' }" class="my-4">
            <p class="text-xl font-bold">x-data, x-text, x-html</p>
            <p x-text="name"></p>
            <p x-html="message"></p>
        </div>
    </div>
</x-layout>
