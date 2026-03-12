<?php

namespace App\Http\Controllers;

use App\Actions\Orders\CreateOrder;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Queries\Orders\GetOrderCreatePageData;
use App\Queries\Orders\GetOrderDetails;
use App\Queries\Orders\ListOrders;
use Illuminate\Http\RedirectResponse;
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

    public function create(GetOrderCreatePageData $getOrderCreatePageData): Response
    {
        return Inertia::render('Orders/Create', $getOrderCreatePageData->handle());
    }

    public function store(StoreOrderRequest $request, CreateOrder $createOrder): RedirectResponse
    {
        $order = $createOrder->handle(
            $request->string('customer_name')->toString(),
            $request->validated('items'),
        );

        return redirect()->route('orders.show', $order);
    }

    public function show(Order $order, GetOrderDetails $getOrderDetails): Response
    {
        return Inertia::render('Orders/Show', [
            'order' => $getOrderDetails->handle($order),
        ]);
    }
}
