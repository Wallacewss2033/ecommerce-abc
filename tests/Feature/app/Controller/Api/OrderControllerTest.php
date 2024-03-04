<?php

namespace Tests\Feature\app\Controller\Api;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    public function test_endpoint_create_orders(): void
    {
        $products = Product::factory()->createMany([
            [
                'name' => 'Celular 01',
                'price' => 10.50,
                'description' => 'Celular top de linha',
                'available' => true,
            ],
            [
                'name' => 'Celular 01',
                'price' => 25.99,
                'description' => 'Celular top de linha',
                'available' => true,
            ]
        ]);

        $total = 0;
        $products = $products->toArray();

        $products[1]['amount'] = 1;
        $products[0]['amount'] = 2;

        $response = $this->post('/api/orders/create', [
            'products' => $products
        ]);

        foreach ($products as $product) {
            $total += $product["price"] * $product["amount"];
        }

        $result = number_format($total, 2);
        $this->assertEquals(46.99, $result);
        $response->assertStatus(201);
    }

    public function test_endpoint_list_of_orders_without_filter(): void
    {
        $response = $this->get('/api/orders');

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data",
            ]);
    }

    public function test_endpoint_list_of_orders_with_filter(): void
    {
        $response = $this->get('/api/orders', [
            'filter' => ["status" => "CART"]
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data",
            ]);
    }

    public function test_endpoint_of_orders_specific(): void
    {
        $id = Order::first()->id;

        $response = $this->get("/api/orders/" . $id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data",
            ]);
    }

    public function test_endpoint_of_cancel_orders_specific(): void
    {
        $id = Order::first()->id;
        $response = $this->delete("/api/orders/cancel/" . $id);

        $response->assertStatus(200);
    }
}
