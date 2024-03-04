<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;

class OrderService
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function createOrder(array $request): void
    {
        $total = 0;
        foreach ($request["products"] as $product) {
            $total += $product["price"] * $product["amount"];
        }

        $productsIds = array_column($request["products"], 'id');

        $this->order->create([
            'price' => $total,
            'productJson' => json_encode($request["products"]),
            'status' => OrderStatusEnum::PENDING,
        ])->products()->attach($productsIds);
    }

    public function listOrders(array $request)
    {
        if (isset($request["filter"]["status"]) && !empty($request["filter"]["status"])) {
            $status = $request["filter"]["status"];
            return $this->order->where('status', OrderStatusEnum::getName($status))->get();
        }
        return $this->order->get();
    }

    public function getOrdersById($id)
    {
        return $this->order::where('id', $id)->get();
    }
}
