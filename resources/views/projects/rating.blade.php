<x-layout>

    <div class="main-font bg-[#141519] flex flex-col justify-evenly items-center h-screen">
        <main x-data="{ activeSelection: '', submitted: false }" class="bg-[#1E252F] w-[340px] p-6 rounded-xl">
        <div x-show="!submitted">
            <div class="bg-[#262F38] p-3 rounded-full w-10">
            <img src="images/icon-star.svg" alt="icon star">
            </div>
            <p class="text-white font-bold mt-6 text-xl">How did we do?</p>
            <p class="text-sm text-gray-500 my-4">Please let us know how we did with your support request. All feedback is appreciated to help us improve our offering!</p>
            <div class="flex justify-between my-2">
            <div 
                x-on:click="activeSelection = '1'" 
                class="flex justify-center items-center bg-[#262F38] text-gray-500 font-bold rounded-full cursor-pointer py-2 px-4 hover:bg-[#FC7613] hover:text-white"
                :class="activeSelection === '1' ? ['text-[#FFF]', 'bg-[#7D8795]'] : ''">
                <input id=1 class="hidden" name="rating" type=radio><label for=1 class="cursor-pointer">1</label>
            </div>
            <div 
                x-on:click="activeSelection = '2'" 
                class="flex justify-center items-center bg-[#262F38] text-gray-500 font-bold rounded-full cursor-pointer py-2 px-4 hover:bg-[#FC7613] hover:text-white"
                :class="activeSelection === '2' ? ['text-[#FFF]', 'bg-[#7D8795]'] : ''">
                <input id=2 class="hidden" name="rating" type=radio><label for=2 class="cursor-pointer">2</label>
            </div>
            <div 
            x-on:click="activeSelection = '3'" 
            class="flex justify-center items-center bg-[#262F38] text-gray-500 font-bold rounded-full cursor-pointer py-2 px-4 hover:bg-[#FC7613] hover:text-white"
            :class="activeSelection === '3' ? ['text-[#FFF]', 'bg-[#7D8795]'] : ''">
                <input id=3 class="hidden" name="rating" type=radio><label for=3 class="cursor-pointer">3</label>
            </div>
            <div 
            x-on:click="activeSelection = '4'" 
            class="flex justify-center items-center bg-[#262F38] text-gray-500 font-bold rounded-full cursor-pointer py-2 px-4 hover:bg-[#FC7613] hover:text-white"            
            :class="activeSelection === '4' ? ['text-[#FFF]', 'bg-[#7D8795]'] : ''">
                <input id=4 class="hidden" name="rating" type=radio><label for=4 class="cursor-pointer">4</label>
            </div>
            <div 
            x-on:click="activeSelection = '5'" 
            class="flex justify-center items-center bg-[#262F38] text-gray-500 font-bold rounded-full cursor-pointer py-2 px-4 hover:bg-[#FC7613] hover:text-white"
            :class="activeSelection === '5' ? ['text-[#FFF]', 'bg-[#7D8795]'] : ''">
                <input id=5 class="hidden" name="rating" type=radio><label for=5 class="cursor-pointer">5</label>
            </div>
            </div>
            <button 
            class="bg-[#FC7613] text-white font-semibold text-sm tracking-widest w-full rounded-full py-2 mt-4 hover:bg-white hover:text-[#FC7613]"
            x-on:click="submitted = 'true'"
            >
            SUBMIT
            </button>
        </div>
        <div x-show="submitted" class="py-4 text-center">
            <img src="images/illustration-thank-you.svg" alt="thank you" class="mx-auto mb-2">
            <div class="bg-[#262F38] text-[#FC7613] text-sm inline-block rounded-full px-3 py-1.5 mt-5">You selected <span x-text="activeSelection"></span> out of 5</div>
            <p class="text-white font-bold my-5 text-xl">Thank you!</p>
            <p class="text-sm text-gray-500">We appreciate you taking the time to give a rating. If you ever need more support, don't hesitate to get in touch!</p>  
        </div>
        </main>
    </div>
</x-layout>
