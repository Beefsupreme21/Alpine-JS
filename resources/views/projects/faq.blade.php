
<x-layout>
  <div x-data="{ faq1: false, faq2: false, faq3: false, faq4: false, faq5: false }" 
    class="flex justify-center items-center main-font bg-gradient-to-b from-[#AF67E9] to-[#6565E7] h-screen px-6">
    <div class="relative md:flex items-center bg-white border rounded-2xl w-80 md:w-[800px] h-[480px] ">
      <div class="absolute md:hidden left-0 right-0 -top-28 w-60 mx-auto">
        <img src="images/illustration-woman-online-mobile.svg" alt="">
      </div>
      <div class="hidden md:block relative right-16 w-96">
        <img src="images/illustration-woman-online-desktop.svg" alt="">
        <div class="absolute top-24 -left-8">
          <img src="images/illustration-box-desktop.svg" alt="">
        </div>
      </div>
      <div class="w-80">
        <p class="text-center md:text-left text-3xl font-bold pt-24 pb-8 md:p-0">FAQ</p>
        <div class="text-sm px-6 md:p-0">

          <div x-on:click="faq1 = !faq1, faq2 = false, faq3 = false, faq4 = false, faq5 = false" 
          class="flex items-center justify-between cursor-pointer"
          :class="faq1 === true ? 'font-bold' : 'text-gray-600'">
            <p class="py-3">How many team members can I invite?</p>
            <img x-show="!faq1" src="images/icon-arrow-down.svg" alt="">
            <img x-show="faq1" class="origin-center rotate-180" src="images/icon-arrow-down.svg" alt="">
          </div>
          <div x-show="faq1" class="pb-3">
            <p class="text-xs text-gray-500 pr-3">You can invite up to 2 additional users on the Free plan. There is no limit on team members for the Premium plan.</p>
          </div>
          <hr>
  
          <div x-on:click="faq1 = false, faq2 = !faq2, faq3 = false, faq4 = false, faq5 = false" 
          class="flex items-center justify-between cursor-pointer"
          :class="faq2 === true ? 'font-bold' : 'text-gray-600'">
            <p class="py-3">What is the maximum file upload size?</p>
            <img x-show="!faq2" src="images/icon-arrow-down.svg" alt="">
            <img x-show="faq2" class="origin-center rotate-180" src="images/icon-arrow-down.svg" alt="">
          </div>
          <div x-show="faq2" class="pb-3">
            <p class="text-xs text-gray-500 pr-3">No more than 2GB. All files in your account must fit your allotted storage space.</p>
          </div>
          <hr>
  
          <div x-on:click="faq1 = false, faq2 = false, faq3 = !faq3, faq4 = false, faq5 = false" 
          class="flex items-center justify-between cursor-pointer"
          :class="faq3 === true ? 'font-bold' : 'text-gray-600'">
            <p class="py-3">How do I reset my password?</p>
            <img x-show="!faq3" src="images/icon-arrow-down.svg" alt="">
            <img x-show="faq3" class="origin-center rotate-180" src="images/icon-arrow-down.svg" alt="">
          </div>
          <div x-show="faq3" class="pb-3">
            <p class="text-xs text-gray-500 pr-3">Click “Forgot password” from the login page or “Change password” from your profile page. A reset link will be emailed to you.</p>
          </div>
          <hr>
  
          <div x-on:click="faq1 = false, faq2 = false, faq3 = false, faq4 = !faq4, faq5 = false" 
          class="flex items-center justify-between cursor-pointer"
          :class="faq4 === true ? 'font-bold' : 'text-gray-600'">
            <p class="py-3">Can I cancel my subscription?</p>
            <img x-show="!faq4" src="images/icon-arrow-down.svg" alt="">
            <img x-show="faq4" class="origin-center rotate-180" src="images/icon-arrow-down.svg" alt="">
          </div>
          <div x-show="faq4" class="pb-3">
            <p class="text-xs text-gray-500 pr-3">Yes! Send us a message and we’ll process your request no questions asked.</p>
          </div>
          <hr>
  
          <div x-on:click="faq1 = false, faq2 = false, faq3 = false, faq4 = false, faq5 = !faq5" 
          class="flex items-center justify-between cursor-pointer"
          :class="faq5 === true ? 'font-bold' : 'text-gray-600'">
            <p class="py-3">Do you provide additional support?</p>
            <img x-show="!faq5" src="images/icon-arrow-down.svg" alt="">
            <img x-show="faq5" class="origin-center rotate-180" src="images/icon-arrow-down.svg" alt="">
          </div>
          <div x-show="faq5" class="pb-3">
            <p class="text-xs text-gray-500 pr-3">Chat and email support is available 24/7. Phone lines are open during normal business hours.</p>
          </div>
          <hr>
  
        </div>
      </div>
    </div>
  </div>
</x-layout>
