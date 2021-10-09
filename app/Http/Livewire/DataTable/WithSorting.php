<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Illuminate\Database\Query\Builder;

trait WithSorting
{
    public $sortField = 'title';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($field == $this->sortField) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    /**
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     *
     * @return void
     */
    public function applySorting($query)
    {
        return $query->orderBy($this->sortField, $this->sortDirection);
    }
}
