<x-layouts.base>
    <section x-data="{ sideBar: false }" class="min-h-screen bg-gray-50">
        <nav :class="{ '-translate-x-full' : !sideBar, 'translate-x-0' : sideBar }" @click.away="sideBar = false" class="fixed top-0 left-0 z-20 h-full pb-10 overflow-x-hidden overflow-y-auto transition origin-left transform bg-gray-900 w-60 md:translate-x-0">
            <a href="/" class="flex items-center px-4 py-5">
                <img src="/img/Sofrosine-light.svg" alt="Sofrosine Logo" class="w-20" />
            </a>
            <nav class="text-sm font-medium text-gray-500" aria-label="Main Navigation">
                <a class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200" href="#">
                    <x-icons.home class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" />
                    <span>Home</span>
                </a>
                <a class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200"  href="#">
                    <x-icons.broadcast class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300"  />
                    <span>Articles</span>
                </a>
                <a class="flex items-center px-4 py-3 text-gray-200 transition bg-gray-800 cursor-pointer group hover:bg-gray-800 hover:text-gray-200" href="#">
                    <x-icons.folders  class="flex-shrink-0 w-5 h-5 mr-2 text-gray-300 transition group-hover:text-gray-300"  />
                    <span>Collections</span>
                </a>
                <a class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200" href="#">
                    <x-icons.checklist class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" />
                    <span>Checklists</span>
                </a>
                <div x-data="collapse()">
                    <div x-spread="trigger" class="flex items-center justify-between px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200" role="button">
                        <div class="flex items-center">
                            <x-icons.code class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" />
                            <span>Integrations</span>
                        </div>
                        <x-icons.arrow-left x-bind:class="{ 'rotate-90': open }" class="flex-shrink-0 w-4 h-4 ml-2 transition transform" />
                    </div>
                    <div class="mb-4" x-spread="collapse" x-cloak>
                        <a class="flex items-center py-2 pl-12 pr-4 transition cursor-pointer hover:bg-gray-800 hover:text-gray-200" href="#">
                            Shopify
                        </a>
                        <a class="flex items-center py-2 pl-12 pr-4 transition cursor-pointer hover:bg-gray-800 hover:text-gray-200" href="#">
                            Slack
                        </a>
                        <a class="flex items-center py-2 pl-12 pr-4 transition cursor-pointer hover:bg-gray-800 hover:text-gray-200" href="#">
                            Zapier
                        </a>
                    </div>
                </div>
                <a class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200" href="#">
                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd" />
                        <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z" />
                    </svg>
                    <span>Changelog</span>
                </a>
                <a class="flex items-center px-4 py-3 transition cursor-pointer group hover:bg-gray-800 hover:text-gray-200" href="#">
                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400 transition group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    <span>Settings</span>
                </a>
            </nav>
        </nav>
        <div class="ml-0 transition md:ml-60">
            <header class="flex items-center justify-between w-full px-4 h-14">
                <button @click.stop="sideBar = true" class="block btn btn-light-secondary md:hidden" >
                    <span class="sr-only">Menu</span>
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="hidden -ml-3 form-icon md:block w-96">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input class="bg-transparent border-0 form-input" placeholder="Search for articles..." />
                </div>
                <div class="flex items-center">
                    <a href="#" class="flex text-gray-500">
                        <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                    </a>
                    <a href="#" class="ml-4 avatar avatar-sm">
                        <img src="/img/face.jpg" alt="Photo of user" />
                    </a>
                </div>
            </header>
            <div class="p-4">
                <!-- Add content here, remove div below -->
                <div class="-mt-2 border-4 border-dashed rounded h-96">
                    {{ $slot }}
                </div>
            </div>
        </div> <!-- Sidebar Backdrop -->
        <div x-show.transition="sideBar"  x-cloak class="fixed inset-0 z-10 w-screen h-screen bg-black bg-opacity-25 md:hidden">
        </div>
    </section>
</x-layouts.base>
