<div>
    <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>

    <form wire:submit.prevent="save">
        <div class="mt-6 sm:mt-5 space-y-6">
            <x-input.group label="Username" for="username" :error="$errors->first('user.username')">
                <x-input.text wire:model="user.username" id="username"  leading-add-on="sofrosine.com/" />
            </x-input.group>

            <x-input.group label="Birthday" for="birthday" :error="$errors->first('user.birthday')">
                <x-input.date wire:model="user.birthday" id="birthday"  placeholder="DD/MM/YY" />
            </x-input.group>

            <x-input.group label="About" for="about" :error="$errors->first('user.about')" help-text="Write a few sentences about yourself." >
                <x-input.rich-text wire:model.defer="user.about" id="about"  />
            </x-input.group>

            <x-input.group label="Photo" for="photo" :error="$errors->first('upload')">
                <x-input.file-upload wire:model="upload" id="photo" :new-avatar="$upload">
                    <span>
                        @if($upload)
                            <img src="{{ $upload->temporaryUrl() }}" class="inline-block h-10 w-10 rounded-full" alt="Profile Photo">
                        @else
                            <img src="{{ auth()->user()->avatarUrl() }}" class="inline-block h-10 w-10 rounded-full"  alt="Profile Photo">
                        @endif
                    </span>
                </x-input.file-upload>
            </x-input.group>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="space-x-3 flex justify-end items-center">
                <span>
                    <span
                        x-data="{open: false}"
                        x-init="
                            @this.on('notify-saved', () => {
                                setTimeout(() => {open = false}, 2500);
                                open = true
                            })
                        "
                        x-show.transition.out.duration.1000ms="open"
                        x-ref="this"
                        class="text-gray-500"
                        style="display: none"
                    >
                        Saved
                    </span>
                </span>
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button"
                        class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </button>
                </span>
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>
