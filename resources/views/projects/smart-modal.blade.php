<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Smart Model</p>
            </div>
            <p>When clicking on the edit or delete for a user, we will know which user it was clicked on</p>

            <div x-data="table" class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-2xl font-semibold mt-10 mb-8 leading-6 text-gray-900">Users</h1>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <a href="/admin/users/create" class="bg-indigo-600 px-4 py-2">Create User</a>
                    </div>
                </div>
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Email</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 w-12"></th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 w-12"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <template x-for="user in users" :key="user.id">
                                            <tr>
                                                <td x-text="user.id" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                                <td x-text="user.name" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                                <td x-text="user.email" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                                <td class="px-4 py-2">
                                                    <a @click="currentUser = user" x-bind:href="'/admin/users/' + currentUser.id + '/edit'">
                                                        <x-svg.edit class="w-6 h-6 hover:stroke-[#4099de]" />
                                                    </a>
                                                </td>
                                                <td class="px-4 py-2">
                                                    <button @click="showModal = true; currentUser = user">
                                                        <x-svg.delete class="w-6 h-6 hover:stroke-[#4099de]" />             
                                                    </button>
                                                    <div x-show="showModal" @click.away="showModal = false"
                                                    class="fixed inset-0 z-50 flex justify-center items-center px-4 py-8 bg-gray-900 bg-opacity-25">
                                                        <div @click.away="showModal = false" class="relative max-w-md rounded-lg shadow-xl overflow-hidden">
                                                            <div class="bg-white px-8 pt-6 pb-4">
                                                                <h2 class="mb-6 text-90 font-normal text-xl">Delete User</h2>
                                                                <p class="text-lg text-gray-600 mb-4">Are you sure you want to delete this user?</p>
                                                                <div class="flex justify-end">
                                                                    <button @click="showModal = false" class="text-gray-600 font-bold py-2 px-4 rounded-lg">
                                                                        Cancel            
                                                                    </button>
                                                                    <form method="POST" x-bind:action="'/admin/users/' + currentUser.id">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="bg-red-500 text-white font-bold ml-4 py-2 px-4 rounded-lg">
                                                                            Delete            
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/plain" class="language-markup max-w-[680px]">
                <div x-data="table" class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-2xl font-semibold mt-10 mb-8 leading-6 text-gray-900">Users</h1>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a href="/admin/users/create" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Create User</a>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Email</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 w-12"></th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 w-12"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <template x-for="user in users" :key="user.id">
                                                <tr>
                                                    <td x-text="user.id" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                                    <td x-text="user.name" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                                    <td x-text="user.email" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                                    <td class="px-4 py-2">
                                                        <a @click="currentUser = user" x-bind:href="'/admin/users/' + currentUser.id + '/edit'">
                                                            <x-svg.edit class="w-6 h-6 hover:stroke-[#4099de]" />
                                                        </a>
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <button @click="showModal = true; currentUser = user">
                                                            <x-svg.delete class="w-6 h-6 hover:stroke-[#4099de]" />             
                                                        </button>
                                                        <div x-show="showModal" @click.away="showModal = false"
                                                        class="fixed inset-0 z-50 flex justify-center items-center px-4 py-8 bg-gray-900 bg-opacity-25">
                                                            <div @click.away="showModal = false" class="relative max-w-md rounded-lg shadow-xl overflow-hidden">
                                                                <div class="bg-white px-8 pt-6 pb-4">
                                                                    <h2 class="mb-6 text-90 font-normal text-xl">Delete User</h2>
                                                                    <p class="text-lg text-gray-600 mb-4">Are you sure you want to delete this user?</p>
                                                                    <div class="flex justify-end">
                                                                        <button @click="showModal = false" class="text-gray-600 font-bold py-2 px-4 rounded-lg">
                                                                            Cancel            
                                                                        </button>
                                                                        <form method="POST" x-bind:action="'/admin/users/' + currentUser.id">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="bg-red-500 text-white font-bold ml-4 py-2 px-4 rounded-lg">
                                                                                Delete            
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </script>

            <script type="text/plain" class="language-javascript max-w-[680px]">
                document.addEventListener('alpine:init', () => {
                    Alpine.data('table', () => ({
                        users: @json($users),
                        showModal: false,
                        currentUser: null,
                    }))
                })
            </script>
        </div>
    </div>
</x-layout>
