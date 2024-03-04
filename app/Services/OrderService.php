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

    public function listOrders(array $request)
    {
        if (isset($request["filter"]["status"]) && !empty($request["filter"]["status"])) {
            $status = $request["filter"]["status"];
            return $this->order->where('status', OrderStatusEnum::getName($status))->with('products');
        }
        return $this->order->with('products');
    }

    public function getOrdersById($id)
    {
        return $this->order::where('id', $id)->with('products');
    }
}
