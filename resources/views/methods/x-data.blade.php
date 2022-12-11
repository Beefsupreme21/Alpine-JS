<x-layout>
    <div class="w-4/5 mx-auto test">
        <div class="my-5">
            <p class="text-center text-3xl font-bold">x-data</p>
        </div>

        <div class="text-center my-5">
            <p>Everything in Alpine starts with the x-data directive.</p>
        </div>


        <hr>

        <div class="my-5">
            Occasionally, you want to create an Alpine component, but you don't need any data. In these cases, you can always pass in an empty object.
        </div>

        <div class="text-center">
            <pre>
                <span class="text-gray-500">&lt;</span><span class="text-blue-500">div</span> <span class="text-cyan-500">x-data</span>="{}"&gt;
                &lt;div <span class="text-cyan-500">x-data</span>&gt;
            </pre>
        </div>
        <hr>

        <div class="my-5">
            You can store the data directly in the component
        </div>

        <div class="text-center">
            <pre>
                &lt;div <span class="text-blue-500">x-data</span>="{ open: false }"&gt;
                &lt;div <span class="text-blue-500">x-data</span>="{ message: 'Click me to change' }&gt;
                &lt;div <span class="text-blue-500">x-data</span>="{ change(){ this.message = 'Change message' } }&gt;

            </pre>
        </div>
        <hr>


        <div class="flex">
            <script type="text/plain" class="language-markup">
                <div x-data="{ open: false }" class="border border-green-500 text-center ">
                    <button x-on:click="open = ! open">Toggle Dropdown</button>
                    <div x-show="open">
                        Dropdown Contents...
                    </div>
                </div>
            </script>
    
            <pre class="language-html">
                <code>
                    <p>This is an HTML code block.</p>
                </code>
            </pre>
        </div>


    </div>
</x-layout>
