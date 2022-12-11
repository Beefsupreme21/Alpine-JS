<x-layout>
    <div class="w-11/12 md:w-4/5 mx-auto text-white">
        <div class="my-4">
            <p class="text-center text-3xl font-bold">x-show</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div x-data="{ open: false }" class="border border-green-500 text-center ">
                <button x-on:click="open = ! open">Toggle Dropdown</button>
                <div x-show="open">
                    Dropdown Contents...
                </div>
            </div>

            <div class="border border-red-500">
                <pre class="relative right-40">
                    &lt;div x-data="{ open: false }"&gt;
                        &lt;button x-on:click="open = ! open"&gt;
                        &lt;/button&gt;
                        &lt;div&gt; x-show="open"
                            Dropdown Contents...
                        &lt;/div&gt;
                    &lt;/div&gt;	
                </pre>
            </div>
        </div>
    </div>
</x-layout>
