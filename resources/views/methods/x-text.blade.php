<x-layout>
    <div class="w-11/12 md:w-4/5 mx-auto text-white">
        <div class="my-4">
            <p class="text-center text-3xl font-bold">x-text/x-html</p>
        </div>

        <div>
            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


            <div x-data="{}" class="border border-green-500 text-center ">
                <div>
                    Copyright ©
                    <span x-text="new Date().getFullYear()"></span>
                </div>
            </div>

            <div class="border border-red-500">
                <pre class="relative right-40">
                    &lt;div x-data="{}"&gt;
                        Copyright © 
                        &lt;span&gt;<span class="text-gray-500">x-text</span>="new Date().getFullYear()"&lt;/span&gt;
                    &lt;/div&gt;	
                </pre>
            </div>
        </div>
    </div>
</x-layout>
