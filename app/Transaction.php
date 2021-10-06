<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public const STATUSES = [
        'success' => 'Success',
        'failed' => 'Failed',
        'processing' => 'Processing',
    ];

    protected $guarded = [];
    protected $casts = ['date' => 'date'];

    public function getStatusColorAttribute()
    {
        return [
            'success' => 'green',
            'failed' => 'red'
        ][$this->status] ?? 'gray';
    }

    public function getDateForHumansAttribute()
    {
        return $this->date->format('M, d Y');
    }

    public function getDateForEditingAttribute()
    {
        return $this->date->format('m/d/Y');
    }

    public function setDateForEditingAttribute($value)
    {
        $this->date = Carbon::parse($value);
    }
}
