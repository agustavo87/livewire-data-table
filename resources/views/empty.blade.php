<x-layouts.base>
    <section class="max-w-lg px-4 py-8 mx-auto">
        <img class="mx-auto sm:w-4/5" src="/img/home-interaction.svg" />
        <h2 class="mt-2 text-lg font-medium text-center text-gray-800">Welcome Home!</h2>
        <p class="mt-1 text-center text-gray-600">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod maxime maiores consectetur necessitatibus animi ea veniam optio eos! Id animi et excepturi earum aliquid deleniti.
        </p>
        <div class="flex flex-col items-center justify-center mt-6 space-y-1 md:flex-row md:space-y-0 md:space-x-1">
            <a href="#" class="w-full md:w-auto btn btn-primary">Request access</a>
            <a href="{{ route('logout') }}" class="w-full md:w-auto btn btn-light">Logout</a>
        </div>
      </section>
</x-layouts.base>
