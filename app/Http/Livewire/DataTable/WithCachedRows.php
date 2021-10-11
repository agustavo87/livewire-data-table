<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

trait WithCachedRows
{
    protected $useCache = false;

    public function cache($callback)
    {
        // Component id
        $cacheKey = $this->id;
        if ($this->useCache && Cache::has($cacheKey)) {
            Log::info('usign cache', ['cache key' => $cacheKey]);
            return Cache::get($cacheKey);
        }
        $result = $callback();
        Cache::put($cacheKey, $result);
        return $result;
    }


    public function useCachedRows()
    {
        $this->useCache = true;
    }
}
