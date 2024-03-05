<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index(Request $request, OrderService $orderService)
    {
        $orders = $orderService->listOrders($request);
        return OrderResource::collection($orders);
    }

    public function store(Request $request, OrderService $orderService)
    {
        $orderService->createOrder($request);
        return response()->json([
            'message' => 'Venda realizada com sucesso!'
        ], 201);
    }

    public function show($id, OrderService $orderService)
    {
        $orders = $orderService->getOrdersById($id);
        return OrderResource::collection($orders);
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        if (!$order) {
            throw new NotFoundHttpException();
        }
        $order->delete();
        return response()->json(['message' => 'Venda cancelada com sucesso']);
    }
}
