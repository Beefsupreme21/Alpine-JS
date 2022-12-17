<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="my-5">
            <h1 class="text-center text-3xl font-bold">x-show</h1>
        </div>
        <div class="text-center text-lg mt-5 mb-16">
            <h2>Toggle the visibility of an element</h2>
        </div>

        <div class="my-5">
            <div x-data="{ open: false }">
                <button x-on:click="open = ! open">Toggle Dropdown</button>
                <div x-show="open">
                    Dropdown Contents...
                </div>
            </div>
        </div>


        <script type="text/plain" class="language-markup">
            <div x-data="{ open: false }" class="border border-green-500 text-center ">
                <button x-on:click="open = ! open">Toggle Dropdown</button>
                <div x-show="open">
                    Dropdown Contents...
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