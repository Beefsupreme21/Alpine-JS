<x-layout>

    <div x-data="{ message: '' }" class="container mx-auto p-4">
        <input type="text" x-model="message" class="border rounded p-2 w-full" />
        <p class="text-gray-700 mt-2">Your message: {{ message }}</p>
      </div>
      
      
</x-layout>
