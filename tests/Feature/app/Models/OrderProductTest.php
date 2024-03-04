<?php

namespace Tests\Feature\app\Models;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    public function test_model_of_order_product(): void
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
            'status' => 1,
            'productJson' => $product
        ]);

        $order->products()->attach($product->id);

        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_the_relationship_between_order_and_product(): void
    {
        $product = Product::create([
            'name' => 'Celular 13',
            'price' => 12.99,
            'description' => 'Celular top de linha',
            'available' => true,
        ]);

        $product->amount = 1;

        $order = Order::create([
            'price' => 21.98,
            'status' => 1,
            'productJson' => $product,
        ]);

        $order->products()->attach($product->id);

        $orderWithProducts = Order::with('products')->find($order->id)->toArray();

        $this->assertArrayHasKey('products', $orderWithProducts);
    }
}
