<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;
/**
 * @property \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $selectedRowsQuery
 */
trait WithBulkActions
{
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];

    public function initializeWithBulkActions()
    {
        /* No funca */
        // $this->beforeRender(function () {
        //     if ($this->selectAll) { $this->selectPageRows(); }
        // });
    }

    public function updatedSelectPage($value)
    {
        if ($value) return $this->selectPageRows();
        $this->selected = [];
    }

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function selectPageRows()
    {
        $this->selected = $this->rows->pluck('id')->map(fn ($id) => (string) $id);
    }

    /**
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function getSelectedRowsQueryProperty()
    {
        return (clone $this->rowsQuery)
            ->unless($this->selectAll, fn ($query) => $query->whereKey($this->selected));
    }
}
