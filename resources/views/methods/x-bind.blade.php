<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-bind</h1>
            <h2 class="text-xl mt-5 mb-16">Transition an element in and out using CSS transitions</h2>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Binding classes</p>
            </div>
            <p>x-bind is most often useful for setting specific classes on an element based on your Alpine state.</p>
            <div x-data="{ open: false }" class="h-16 mt-5">
                <button x-on:click="open = ! open">Toggle Dropdown</button>
                <div :class="open ? '' : 'hidden'">
                  Dropdown Contents...
                </div>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false }">
                    <button x-on:click="open = ! open">Toggle Dropdown</button>
                    <div :class="open ? '' : 'hidden'">
                      Dropdown Contents...
                    </div>
                </div>
            </script>
        </div>

        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Binding multiple classes</p>
            </div>
            <p>Not sure of the best way to bind multiple classes</p>
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Using CSS</p>
              </div>
            <p class="my-4">Looks like you can use an array if you're using regular CSS</p>
            <div x-data="{clicked: false}" class="my-4">
                <button
                    class="red"
                    :class="clicked ? ['green', 'purple'] : ''"
                    @click="clicked = !clicked">
                    Click me
                </button>
            </div>
        
            <style>
                .red {
                    background-color: red;
                }
                .green {
                    background-color: green;
                }
                .purple {
                    color: purple;
                }
            </style>

            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{clicked: false}" class="my-4">
                    <button
                      class="red"
                      :class="clicked ? ['green', 'purple'] : ''"
                      @click="clicked = !clicked"
                    >
                      Click me
                    </button>
                  </div>
                
                  <style>
                    .red {
                      background-color: red;
                    }
                    .green {
                      background-color: green;
                    }
                    .purple {
                      color: purple;
                    }
                  </style>
            </script>
        </div>
        

        <div class="my-5">
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Using Tailwind</p>
            </div>
        </div>






    <div x-data="{ open: false }">
        <button
            x-bind:class="{ ['text-blue-500', 'bg-purple-500']: open, 'text-gray-500': !open }"
            x-on:click="open = !open">
            Toggle
        </button>
    </div>


    <div x-data="{ open: false }">
        <button
            x-bind:class="{ ...(open ? ['text-blue-500', 'bg-purple-500'] : ['text-gray-500']), }"
            x-on:click="open = !open">
            Toggle
        </button>
    </div>

    <div x-data="{ open: false }">
        <button
            x-bind:class="{ 'text-black': open, 'bg-yellow-500': open, 'text-gray-500': !open }"
            x-on:click="open = !open">
            Toggle
        </button>
    </div>




    
      
      
      
</x-layout>
