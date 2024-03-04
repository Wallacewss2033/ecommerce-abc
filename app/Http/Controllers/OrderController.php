<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
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

    public function index(Request $request, OrderService $orderService)
    {
        $orders = $orderService->listOrders($request->all());
        return OrderResource::collection($orders->get());
    }

    public function store(Request $request, OrderService $orderService)
    {
        $orderService->createOrder($request->all());
        return response()->json([
            'message' => 'Venda realizada com sucesso!'
        ], 201);
    }

    public function show($id, OrderService $orderService)
    {
        $orders = $orderService->getOrdersById($id);
        return OrderResource::collection($orders->get());
    }
}
