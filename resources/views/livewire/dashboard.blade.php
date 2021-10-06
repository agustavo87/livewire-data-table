<div>
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>

    <div class="py-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable>Title</x-table.heading>
                <x-table.heading sortable>Amount</x-table.heading>
                <x-table.heading sortable>Status</x-table.heading>
                <x-table.heading sortable>Date</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($transactions as $transaction)
                    <x-table.row>
                        <x-table.cell>
                            <span  class="inline-flex space-x-2 truncate text-sm">
                                <x-icons.cash class="flex-shrink-0 h-5 w-5 text-gray-400 " />
                                <p class="text-gray-600 truncate">
                                    {{ $transaction->title }}
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">${{ $transaction->amount }} </span>
                             USD

                        </x-table.cell>
                        <x-table.cell>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $transaction->status_color}}-100 text-{{ $transaction->status_color}}-800 capitalize">
                                {{ $transaction->status }}
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <time datetime="{{ $transaction->date }}">{{ $transaction->date_for_humans }}</time>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>
</div>
