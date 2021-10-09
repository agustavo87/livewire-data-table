<?php

namespace App\Http\Livewire;

use App\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Response;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

/**
 * App\Http\Livewire\Dashboard
 *
 * @property  \Illuminate\Database\Eloquent\Collection $rows
 * @property  \Illuminate\Database\Eloquent\Builder $rowsQuery
 */
class Dashboard extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions;

    public Transaction $editing;

    public $showFilters = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public array $filters = [
        'search'        => null,
        'status'        => '',
        'amount-min'    => null,
        'amount-max'    => null,
        'date-min'      => null,
        'date-max'      => null,
    ];

    protected $queryString = [];

    public function rules()
    {
        return [
            'editing.title' => 'required',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:' . implode(',', array_keys(Transaction::STATUSES)),
            'editing.date_for_editing' => 'required'
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankTransaction();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function makeBlankTransaction()
    {
        return Transaction::make(['date' => now(), 'status' => 'success']);
    }

    public function edit(Transaction $transaction)
    {
        if ($this->editing->isNot($transaction)) {
            $this->editing = $transaction;
        }
        $this->showEditModal = true;
    }

    public function create()
    {
        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankTransaction();
        }
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function exportSelected()
    {
        return Response::streamDownload(function () {
            echo (clone $this->rowsQuery)
                ->unless($this->selectAll, fn ($query) => $query->whereKey($this->selected))
                ->toCsv();
        }, 'transactions.csv');
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = Transaction::query()
            ->when($this->filters['status'], fn ($query, $status) =>  $query->where('status', $status))
            ->when($this->filters['amount-min'], fn ($query, $amountMin) =>  $query->where('amount', '>=', $amountMin))
            ->when($this->filters['amount-max'], fn ($query, $amounMax) =>  $query->where('amount', '<=', $amounMax))
            ->when($this->filters['date-min'], fn ($query, $dateMin) =>  $query->where('date', '>=', date_create_from_format('d/m/Y', $dateMin)))
            ->when($this->filters['date-max'], fn ($query, $dateMax) =>  $query->where('date', '<=', date_create_from_format('d/m/Y', $dateMax)))
            ->when($this->filters['search'], fn ($query, $search) =>  $query->where('title', 'like', "%$search%"));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        /** @todo pasar esto al trait WithBulkActions cuando sepa como */
        if ($this->selectAll) { $this->selectPageRows(); }
        return view('livewire.dashboard', [
            'transactions' => $this->rows
        ]);
    }
}
