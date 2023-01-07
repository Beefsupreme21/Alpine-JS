<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-if</h1>
            <h2 class="text-xl mt-5 mb-16">Conditionally add/remove a block of HTML from the page entirely.</h2>
            <ul class="list-disc pl-6">
                <li>x-if MUST be declared on a template element</li>
                <li>That template element MUST have only one root element</li>
            </ul>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Transition helper</p>
            </div>
            <div x-data="{ open: false }" class="h-16">
                <button x-on:click="open = ! open">Open/Close</button>
          
                <template x-if="open">
                  <div>Content</div>
                </template>
              </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ open: false }">
                    <button x-on:click="open = ! open">Open/Close</button>
              
                    <template x-if="open">
                      <div>Content</div>
                    </template>
                  </div>
            </script>
        </div>
    </div>
</x-layout>
