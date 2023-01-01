<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-show</h1>
            <h2 class="text-xl mt-5 mb-16">Toggle the visibility of an element</h2>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 1</p>
            </div>
            <div x-data="{ open: false }" class="h-20">
                <button x-on:click="open = ! open">Toggle Dropdown</button>
                <div x-show="open">
                    Dropdown Contents...
                </div>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false }">
                    <button x-on:click="open = ! open">Toggle Dropdown</button>
                    <div x-show="open">
                        Dropdown Contents...
                    </div>
                </div>
            </script>
        </div>


        <div class="mt-10 mb-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 1</p>
            </div>
            <div x-data="{ open: false }" class="mb-5">
                <button x-on:click="open = ! open">Toggle open state</button>
                <div x-show="open">
                    This element is visible.
                </div>
                <div x-show="!open">
                    This element is hidden.
                </div>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false }">
                    <button x-on:click="open = ! open">Toggle Dropdown</button>
                    <div x-show="open">
                        Dropdown Contents...
                    </div>
                </div>
            </script>
        </div>

  




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