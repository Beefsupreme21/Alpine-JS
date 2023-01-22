<div class="hidden md:fixed md:inset-y-0 md:flex md:w-80 md:flex-col">
    <div class="flex min-h-0 flex-1 flex-col bg-[#12141C]">
        <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
            <div class="flex flex-shrink-0 items-center px-6">
                <a href="/" class="flex items-center py-1 font-bold rounded-md text-white hover:text-[#77C1D2]">
                    <img src="{{ asset('images/alpinejs.svg') }}" class="h-16" alt="">
                    <span class="text-3xl ml-2 ">Alpine.js</span>
                </a>
            </div>
            <nav class="mt-5 flex-1 space-y-.5 px-6">
                <a href="/x-data" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-data
                </a>
                <a href="/x-bind" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-bind
                </a>
                <a href="/x-on" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-on
                </a>
                <a href="/x-text" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-text
                </a>
                <a href="/x-html" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-html
                </a>
                <a href="x-model" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-model
                </a>
                <a href="x-show" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-show
                </a>
                <a href="/x-transition" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-transition
                </a>
                <a href="/x-for" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-for
                </a>
                <a href="/x-if" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-if
                </a>
                <a href="/x-init#" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-init
                </a>
                <a href="/x-effect" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-effect
                </a>
                <a href="/x-ref" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-ref
                </a>
                <a href="/x-cloak" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-cloak
                </a>
                <a href="/x-ignore" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    x-ignore
                </a>
                <a href="/users" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center px-2 py-1 font-bold rounded-md">
                    Users
                </a>

                @if (request()->is('users'))
                    <a href="#" class="text-gray-500 hover:bg-gray-700 hover:text-[#77C1D2] flex items-center ml-2 px-2 py-1 rounded-md">
                        Create New User
                    </a>
                @endif
                <a href="/test" class="text-gray-300 text-lg hover:bg-gray-700 hover:text-[#77C1D2] flex items-center mt-8 px-2 py-1 font-bold rounded-md">
                    Testing
                </a>
            </nav>
        </div>
    </div>
</div>
