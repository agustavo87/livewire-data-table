<div class="border-indigo-900 border-t flex flex-shrink-0 p-4">
    <a href=" {{ route('profile') }}" class="flex-shrink-0 w-full group block">
        <div class="flex items-center">
            <div>
                <img class="inline-block h-9 w-9 rounded-full"
                    {{-- src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                    alt="Profile Photo"> --}}
                    src="{{ $avatarUrl }}"
                    alt="Profile Photo">
            </div>

            <div class="ml-3">
                <p class="text-sm leading-5 font-medium text-white">
                    {{ $userName }}
                </p>

                <p
                    class="text-xs leading-4 font-medium text-indigo-300 group-hover:text-indigo-100 transition ease-in-out duration-150">
                    View profile
                </p>
            </div>
        </div>
    </a>
</div>
