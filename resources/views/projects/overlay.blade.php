
<div x-data="{ showOverlay: false }" class="relative w-64 cursor-pointer"
    x-on:mouseover="showOverlay = true" 
    x-on:mouseout="showOverlay = false">
    <img src="images/avatar.jpg" class="border border-red-500" alt="" />
    <div class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" 
        x-show="showOverlay">
        <button class="border border-white text-white py-2 px-4 rounded-lg">
            View
        </button>
    </div>
</div>

