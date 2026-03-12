<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Queries\Orders\GetOrderDetails;
use App\Queries\Orders\ListOrders;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    public function index(ListOrders $listOrders): Response
    {
        return Inertia::render('Orders/Index', [
            'orders' => $listOrders->handle(),
        ]);
    }

    public function show(Order $order, GetOrderDetails $getOrderDetails): Response
    {
        return Inertia::render('Orders/Show', [
            'order' => $getOrderDetails->handle($order),
        ]);
    }
}
