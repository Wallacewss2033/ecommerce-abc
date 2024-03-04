<?php

namespace Tests\Feature\app\Models;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_model_of_order(): void
    {
        $product = Product::create([
            'name' => 'Celular 12',
            'price' => 10.99,
            'description' => 'Celular top de linha',
            'available' => true,
        ]);

        $product->amount = 1;

        $order = Order::create([
            'price' => 21.98,
            'status' => OrderStatusEnum::CART,
            'productJson' => json_encode($product->toArray())
        ]);

        $this->assertDatabaseHas('orders', [
            'price' => $order->price,
            'status' => OrderStatusEnum::CART,
        ]);
    }
}
