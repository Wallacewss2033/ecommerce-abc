<?php

namespace Tests\Feature\app\Controller\Api;

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

        $response = $this->post('/api/orders', [
            'products' => $products->toArray()
        ]);

        $result = number_format(array_sum(array_column($products->toArray(), 'price')), 2);
        $this->assertEquals(36.49, $result);
        $response->assertStatus(201);
    }
}
