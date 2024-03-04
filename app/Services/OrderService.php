<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class OrderService
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function createOrder(array $request): void
    {
        $total = array_sum(array_column($request["products"], 'price'));
        $productsIds = array_column($request["products"], 'id');

        $this->order->create([
            'amount' => $total,
            'status' => OrderStatusEnum::PENDING,
        ])->products()->attach($productsIds);
    }
}
