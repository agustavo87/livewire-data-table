<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Illuminate\Database\Query\Builder;

trait WithSorting
{
    public $sorts = [];

    public function sortBy($field)
    {
        if (!isset($this->sorts[$field]))  return $this->sorts[$field] = 'asc';

        if ($this->sorts[$field] == 'asc') return $this->sorts[$field] = 'desc';

        unset($this->sorts[$field]);
    }

    /**
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     *
     * @return void
     */
    public function applySorting($query)
    {
        foreach ($this->sorts as $field => $direction) {
            $query->orderBy($field, $direction);
        }
        return $query;
    }
}
