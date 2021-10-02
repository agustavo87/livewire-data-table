<section class="bg-gray-50">
    <div class="px-4 py-20 mx-auto max-w-7xl">
      <a href="/" title="Sofrosine Home Page" class="flex items-center justify-start sm:justify-center">
        <img class="h-12" src="/img/Sofrosine.svg" alt="Sofrosine Logo">
      </a>
      <div
        class="w-full px-0 pt-5 pb-6 mx-auto mt-4 mb-0 space-y-4 bg-transparent border-0 border-gray-200 rounded-lg md:bg-white md:border sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12 md:px-6 sm:mt-8 sm:mb-5"
      >
        <form wire:submit.prevent="login" class="pb-1 space-y-4">
          <label class="block">
            <span class="block mb-1 text-xs font-medium text-gray-700">Your Email</span>
            <input wire:model.defer="email" class="form-input @error('name') border-red-500 @enderror" type="email" name="email" placeholder="Ex. james@bond.com" inputmode="email" required />
            @error('email') <div class="text-red-700 text-sm mt-1"> {{ $message }} </div> @enderror
          </label>
          <label class="block">
            <span class="block mb-1 text-xs font-medium text-gray-700">Your Password</span>
            <input wire:model.defer="password" class="form-input @error('password') border-red-500 @enderror" type="password" name="password" placeholder="" required />
            @error('password') <div class="text-red-700 text-sm mt-1"> {{ $message }} </div> @enderror
          </label>
          <div class="flex">
            <input type="submit" class="btn btn-primary mt-5 sm:mt-0 w-full" value="Submit" />
          </div>
        </form>
      </div>
      <p class="my-0 text-xs font-medium text-center text-gray-700 sm:my-5">
        Don't have an account yet?
        <a href=" {{ route('register') }} " class="text-purple-700 hover:text-purple-900">Register</a>
      </p>
    </div>
  </section>
