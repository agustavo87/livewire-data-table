<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPage = 25;

    public function initializeWithPerPagePagination()
    {
        $this->perPage = Session::get('perPage', $this->perPage);
    }

    public function updatedPerPage($value)
    {
        Session::put('perPage', $value);
    }

    /**
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     *
     * @return void
     */
    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }
}
