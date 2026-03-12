<?php

namespace App\Queries\Orders;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class GetRecentOrders
{
    /**
     * @return Collection<int, Order>
     */
    public function handle(int $limit = 25): Collection
    {
        return Order::query()
            ->with(['user', 'items.drink'])
            ->latest()
            ->limit($limit)
            ->get();
    }
}
