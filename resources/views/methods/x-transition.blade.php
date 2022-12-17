<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="my-5">
            <h1 class="text-center text-3xl font-bold">x-transition</h1>
        </div>
        <div class="text-center text-lg mt-5 mb-16">
            <h2>Transition an element in and out using CSS transitions</h2>
        </div>

        {{-- Explaination --}}
        <div class="my-5">
            <p>The x-transition directive takes six arguments: enter, enter-start, enter-end, leave, leave-start, and leave-end. These arguments correspond to the different stages of the transition</p>
            <ul>
                <li>enter: This class is applied to the element when it is added to the DOM</li>
                <li>enter-start: This class is applied to the element at the start of the enter transition</li>
                <li>enter-end: This class is applied to the element at the end of the enter transition</li>
                <li>leave: This class is applied to the element when it is removed from the DOM</li>
                <li>leave-start: This class is applied to the element at the start of the leave transition</li>
                <li>leave-end: This class is applied to the element at the end of the leave transition</li>
            </ul>
        </div>

        {{-- Example --}}
        <div class="my-5">
            <div x-data="{ isOpen: false }">
                <button x-on:click="isOpen = true">Open Modal</button>
                <div x-show="isOpen" x-transition:enter="transition-ease-in" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                  <h1>Modal Title</h1>
                  <p>Modal content goes here</p>
                  <button x-on:click="isOpen = false">Close Modal</button>
                </div>
            </div>
        </div>

        {{-- Code --}}
        <script type="text/plain" class="language-markup">
            <div x-data="{ isOpen: false }">
                <button x-on:click="isOpen = true">Open Modal</button>
                <div x-show="isOpen" x-transition:enter="transition-ease-in" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                  <h1>Modal Title</h1>
                  <p>Modal content goes here</p>
                  <button x-on:click="isOpen = false">Close Modal</button>
                </div>
            </div>
        </script>

        <hr class="mt-5">





    </div>

</x-layout>

{{-- // Get the element you want to show
var element = document.getElementById('my-element');

// Make sure the element exists
if (element) {
  // Set the element's display style to "none" so it is initially hidden
  element.style.display = 'none';

  // Add an event listener for the "click" event
  element.addEventListener('click', function() {
    // When the element is clicked, toggle its display style
    // between "block" and "none"
    if (element.style.display === 'none') {
      element.style.display = 'block';
    } else {
      element.style.display = 'none';
    }
  });
} --}}