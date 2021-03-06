<div>
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>

    <div class="py-4 flex flex-col space-y-4">

        {{-- Top bar --}}
        <div class="flex justify-between">
            <div class="flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Search transactions..." />

                <x-button.link wire:click="toggleShowFilters">@if($showFilters) Hide @endif Advance search</x-button.link>
            </div>

            <div class="flex space-x-2 items-center">
                <x-input.group borderless paddingless for="perPage" label="Per page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="Bulk Actions">
                    <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                        <x-icons.download class="text-gray-400"/><span>Export</span>
                    </x-dropdown.item>
                    <x-dropdown.item type="button" wire:click="$set('showDeleteModal', true)" class="flex items-center space-x-2">
                        <x-icons.trash class="text-gray-400"/> <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown>

                <livewire:import-transactions />

                <x-button.primary wire:click="create" class="flex"><x-icons.plus class="-ml-1.5" />New</x-button.primary>
            </div>
        </div>

        {{-- Advance search --}}
        <div>
            @if($showFilters)
            <div class="bg-gray-200 p-4 rounded shadow-inner flex relative">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input.group inline for="filter-status" label="Status">
                        <x-input.select wire:model="filters.status" id="filter-status">
                            <option value="" disabled>Select Status...</option>

                            @foreach (App\Transaction::STATUSES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group inline for="filter-amount-min" label="Minimum Amount">
                        <x-input.money wire:model.lazy="filters.amount-min" id="filter-amount-min" />
                    </x-input.group>

                    <x-input.group inline for="filter-amount-max" label="Maximum Amount">
                        <x-input.money wire:model.lazy="filters.amount-max" id="filter-amount-max" />
                    </x-input.group>
                </div>
                <div class="w-1/2 pl-2 space-y-4">
                    <x-input.group inline for="filter-date-min" label="Minimum Date">
                        <x-input.date wire:model="filters.date-min" id="filter-date-min" placeholder="MM/DD/YYYY" />
                    </x-input.group>

                    <x-input.group inline for="filter-date-max" label="Maximum Date">
                        <x-input.date wire:model="filters.date-max" id="filter-date-max" placeholder="MM/DD/YYYY" />
                    </x-input.group>

                    <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
                </div>
            </div>
            @endif
        </div>

        {{-- Transactions Table --}}
        <div class="flex flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading wire:click="sortBy('title')" :direction="$sorts['title'] ?? null" class="w-3/6" sortable multi-column>Title</x-table.heading>
                    <x-table.heading wire:click="sortBy('amount')" :direction="$sorts['amount'] ?? null"  sortable multi-column>Amount</x-table.heading>
                    <x-table.heading wire:click="sortBy('status')" :direction="$sorts['status'] ?? null"  sortable multi-column>Status</x-table.heading>
                    <x-table.heading wire:click="sortBy('date')" :direction="$sorts['date'] ?? null"  sortable multi-column>Date</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if($selectPage)
                        <x-table.row class="bg-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $transactions->count() }}</strong> transactions, do you want to select all <strong>{{ $transactions->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-2 text-blue-600">Select All</x-button.link>
                                    </div>
                                    @else
                                    <span>You are currently selecting all <strong>{{ $transactions->total() }}</strong> transactions.</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse($transactions as $transaction)
                        <x-table.row wire:loading.class.delay="opacity-75" wire:key="row-{{ $transaction->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model="selected" value="{{ $transaction->id }}" />
                            </x-table.cell>
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
                            <x-table.cell colspan="6">
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

    {{-- Confirmation Modal --}}
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model="showDeleteModal">
            <x-slot name="title">Delete Transactions</x-slot>
            <x-slot name="content">
                Are you sure you want to delete these transactions? This action is irreversible.
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>


    {{-- Edit Modal --}}
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showEditModal">
            <x-slot name="title">Edit Transaction</x-slot>
            <x-slot name="content">
                <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                    <x-input.text id="title" wire:model.lazy="editing.title"  placeholder="Title" />
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
