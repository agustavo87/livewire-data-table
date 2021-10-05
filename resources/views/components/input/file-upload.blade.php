@props(['id' => 'avatarFile', 'caption' => 'Change'])

<div class="flex items-center">

    {{ $slot }}

    <div x-data="{focused: false}">
        <span class="ml-5 rounded-md shadow-sm">
            <input @focus="focused = true" @blur="focused = false"  id="{{ $id }}" {{ $attributes }} type="file"  class="sr-only">
            <label for="{{ $id }}"
                :class="{'outline-none border-blue-300 shadow-outline-blue' : focused }"
                class="cursor-pointer py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                {{ $caption }}
            </label>
        </span>
    </div>
</div>
