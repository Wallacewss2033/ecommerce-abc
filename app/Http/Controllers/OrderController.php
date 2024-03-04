<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function store(Request $request)
    {
        $orderService = new OrderService($this->order, $request->all());
        $orderService->createOrder();

        return response()->json([
            'message' => 'Venda realizada com sucesso!'
        ], 201);
    }
}
