<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait CachePaginator
{
    public function paginate($items, $perPage = 15, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        return new LengthAwarePaginator(($items->forPage($page, $perPage)->values()), $items->count(), $perPage, $page, $options);
    }
}
