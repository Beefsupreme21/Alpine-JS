<x-layout>
    <div x-data="{ isOpen: false }">
        <button x-on:click="isOpen = true">Open Modal</button>
        <div x-show="isOpen" x-transition:enter="transition-ease-in" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
          <h1>Modal Title</h1>
          <p>Modal content goes here</p>
          <button x-on:click="isOpen = false">Close Modal</button>
        </div>
    </div>
</x-layout>
