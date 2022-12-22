<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-show</h1>
            <h2 class="text-xl mt-5 mb-16">Toggle the visibility of an element</h2>
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
            <div x-data="{ open: false }">
                <button x-on:click="open = ! open">Toggle Dropdown</button>
                <div x-show="open">
                    Dropdown Contents...
                </div>
            </div>
        </script>

  




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