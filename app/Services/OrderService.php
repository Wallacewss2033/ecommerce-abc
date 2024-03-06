<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function createOrder(Request $request): void
    {
        $total = collect($request->input('products'))->sum(function ($product) {
            return $product['price'] * $product['amount'];
        });

        $productsIds = collect($request->input('products'))->pluck('id')->toArray();

        $this->order->create([
            'price' => $total,
            'productJson' => json_encode($request->input('products')),
            'status' => OrderStatusEnum::CART,
        ])->products()->attach($productsIds);
    }

    public function getOrders(Request $request)
    {
        if ($status = $request->input('filter.status')) {
            return $this->order->where('status', OrderStatusEnum::getName($status))->get();
        }
        return $this->order->get();
    }

    public function getOrdersById($id)
    {
        return $this->order::find($id);
    }
}
