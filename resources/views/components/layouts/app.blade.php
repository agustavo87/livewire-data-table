<x-layouts.base>
    <section x-data="{ sideBar: false }" class="min-h-screen bg-gray-50">

        {{-- Side Bar --}}
        <nav @click.away="sideBar = false" :class="{ '-translate-x-full' : !sideBar, 'translate-x-0' : sideBar }"
            class="fixed top-0 left-0 z-20 h-full flex flex-col justify-between transition origin-left transform bg-gray-900 w-60 md:translate-x-0">
            <div class="absolute top-0 right-0 -mr-14 p-1">
                <button x-show="sideBar" @click="sideBar = false"
                    class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                    aria-label="Close sidebar" style="display: none;">
                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div>

                <a href="/" class="flex items-center px-4 py-5">
                    <img src="/img/Sofrosine-light.svg" alt="Sofrosine Logo" class="w-20" />
                </a>
                <nav class="text-sm font-medium text-gray-500 overflow-x-hidden overflow-y-auto"
                    aria-label="Main Navigation">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200">
                        <x-icons.dashboard
                            class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" />
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('logout') }}"
                        class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200">
                        <x-icons.logout
                            class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" />
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
            <div class="border-indigo-900 border-t flex flex-shrink-0 p-4">
                <a href=" {{ route('profile') }}" class="flex-shrink-0 w-full group block">
                    <div class="flex items-center">
                        <div>
                            <img class="inline-block h-9 w-9 rounded-full"
                                {{-- src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                alt="Profile Photo"> --}}
                                src="{{ auth()->user()->avatarUrl() }}"
                                alt="Profile Photo">
                        </div>

                        <div class="ml-3">
                            <p class="text-sm leading-5 font-medium text-white">
                                {{ $user->username }}
                            </p>

                            <p
                                class="text-xs leading-4 font-medium text-indigo-300 group-hover:text-indigo-100 transition ease-in-out duration-150">
                                View profile
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </nav>

        {{--Right Section--}}
        <div class="ml-0 transition md:ml-60">

            {{--Ham Button--}}
            <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                <button @click.stop="sideBar = true"
                    class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
                    aria-label="Open sidebar">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            {{-- Main Section --}}
            <main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0"
                x-data="" x-init="$el.focus()">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    {{ $slot}}
                </div>
            </main>

            <x-notification />
        </div>

        <!-- Sidebar Backdrop -->
        <div x-show.transition="sideBar" x-cloak  class="fixed inset-0 z-10 w-screen h-screen bg-black bg-opacity-25 md:hidden">
        </div>

    </section>
</x-layouts.base>
