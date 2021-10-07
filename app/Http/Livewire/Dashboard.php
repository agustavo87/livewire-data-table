<?php

namespace App\Http\Livewire;

use App\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';

    public $searchField = 'title';
    public $sortField = 'title';
    public $sortDirection = 'asc';
    public $showEditModal = false;
    public Transaction $editing;

    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.title' => 'required',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:' . implode(',', array_keys(Transaction::STATUSES)),
            'editing.date_for_editing' => 'required'
        ];
    }

    public function mount() { $this->editing = $this->makeBlankTransaction(); }

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
        $this->editing = $transaction;
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'transactions' => Transaction::search('title', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }
}
