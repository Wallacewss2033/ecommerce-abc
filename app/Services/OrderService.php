<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class OrderService
{
    protected Order $order;
    protected array $request;

    public function __construct(Order $order, array $request)
    {
        $this->order = $order;
        $this->request = $request;
    }


    public function createOrder(): void
    {
        $total = array_sum(array_column($this->request["products"], 'price'));
        $productsIds = array_column($this->request["products"], 'id');

        $this->order->create([
            'amount' => $total,
            'status' => 1,
        ])->products()->attach($productsIds);
    }
}
