<div x-data="{ selected: '' }">
    <button x-on:click="selected !== 1 ? selected = 1 : selected = ''" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full focus:outline-none focus:shadow-outline">
    Toggle Accordion 1
    </button>
    <div x-show="selected === 1" x-transition.duration.400ms x-cloak class="py-4">
        <p class="p-4">
            Lorem ipsum
        </p>
    </div>
    <button x-on:click="selected !== 2 ? selected = 2 : selected = ''" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full focus:outline-none focus:shadow-outline">
        Toggle Accordion 2
    </button>
    <div x-show="selected === 2" x-transition.duration.400ms x-cloak class="py-4">
        <p class="p-4">
            Lorem ipsum
        </p>
    </div>
</div>