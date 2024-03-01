<?php

namespace Tests\Feature\app\Models;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_of_product()
    {
        $product = Product::factory()->create([
            'name' => 'Celular 01',
            'price' => 10.99,
            'description' => 'Celular top de linha',
            'available' => true,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'available' => $product->available,
        ]);
    }
}
