<?php

namespace App\Http\Livewire;

use App\Transaction;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $sortField = 'title';
    public $sortDirection = 'asc';
    public $showEditModal = false;
    public $showFilters = false;
    public Transaction $editing;
    public $selected = [];
    public array $filters = [
        'search'        => null,
        'status'        => '',
        'amount-min'    => null,
        'amount-max'    => null,
        'date-min'      => null,
        'date-max'      => null,
    ];

    protected $queryString = ['sortField', 'sortDirection'];

    public function rules() { return [
        'editing.title' => 'required',
        'editing.amount' => 'required',
        'editing.status' => 'required|in:' . implode(',', array_keys(Transaction::STATUSES)),
        'editing.date_for_editing' => 'required'
    ];}

    public function mount() { $this->editing = $this->makeBlankTransaction(); }

    public function updatedFilters() { $this->resetPage(); }

    public function makeBlankTransaction()
    {
        return Transaction::make(['date' => now(), 'status' => 'success']);
    }

    public function sortBy($field)
    {
        if ($field == $this->sortField) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
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
            echo Transaction::whereKey($this->selected)->toCsv();
        }, 'transactions.csv');
    }

    public function deleteSelected()
    {
        /** @var \Illuminate\Database\Eloquent\Builder */
        $transactions = Transaction::whereKey($this->selected);
        $transactions->delete();

    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'transactions' => Transaction::query()
                ->when($this->filters['status'], fn($query, $status) =>  $query->where('status', $status))
                ->when($this->filters['amount-min'], fn($query, $amountMin) =>  $query->where('amount', '>=', $amountMin))
                ->when($this->filters['amount-max'], fn($query, $amounMax) =>  $query->where('amount', '<=', $amounMax))
                ->when($this->filters['date-min'], fn($query, $dateMin) =>  $query->where('date', '>=', date_create_from_format('d/m/Y', $dateMin)))
                ->when($this->filters['date-max'], fn($query, $dateMax) =>  $query->where('date', '<=', date_create_from_format('d/m/Y', $dateMax)))
                ->when($this->filters['search'], fn($query, $search) =>  $query->where('title', 'like', "%$search%"))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }
}
