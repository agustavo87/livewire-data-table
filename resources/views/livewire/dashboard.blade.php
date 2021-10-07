<div>
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>

    <div class="py-4 flex flex-col space-y-4">
        <div>
            <div class="w-1/4">
                <x-input.text wire:model="search" placeholder="Search transactions..." />
            </div>
        </div>
        <div class="flex flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading wire:click="sortBy('title')" :direction="$sortField == 'title' ? $sortDirection : null" sortable>Title</x-table.heading>
                    <x-table.heading wire:click="sortBy('amount')" :direction="$sortField == 'amount' ? $sortDirection : null"  sortable>Amount</x-table.heading>
                    <x-table.heading wire:click="sortBy('status')" :direction="$sortField == 'status' ? $sortDirection : null"  sortable>Status</x-table.heading>
                    <x-table.heading wire:click="sortBy('date')" :direction="$sortField == 'date' ? $sortDirection : null"  sortable>Date</x-table.heading>
                    <x-table.heading />
                </x-slot>
                <x-slot name="body">
                    @forelse($transactions as $transaction)
                        <x-table.row wire:loading.class.delay="opacity-75">
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
                            <x-table.cell>
                                <x-button.link wire:click="edit({{ $transaction->id }})" >Edit</x-button.link>
                            </x-table.cell>


                        </x-table.row>
                    @empty
                        <x-table.row wire:loading.class.delay="opacity-75">
                            <x-table.cell colspan="5">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icons.lupa class="h-4 text-gray-400 w-4" />
                                    <span class="font-medium text-gray-500 py-6">
                                        No transactions found...
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <div>{{ $transactions->links() }}</div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showEditModal">
            <x-slot name="title">Edit Transaction</x-slot>
            <x-slot name="content">
                <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                    <x-input.text id="title" wire:model.lazy="editing.title"  />
                </x-input.group>

                <x-input.group for="amount" label="Amount" :error="$errors->first('editing.amount')">
                    <x-input.money id="amount" wire:model.lazy="editing.amount"  />
                </x-input.group>

                <x-input.group for="tatus" label="Status" :error="$errors->first('editing.status')">
                    <x-input.select id="status" wire:model.lazy="editing.status"  >
                        @foreach (\App\Transaction::STATUSES as $code => $label)
                            <option value="{{ $code }}"> {{ $label }} </option>
                        @endforeach
                    </x-input.select>
                </x-input.group>
                <x-input.group for="date_for_editing" label="Date" :error="$errors->first('editing.date_for_editing')">
                    <x-input.date wire:model="editing.date_for_editing" id="date_for_editing" />
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
