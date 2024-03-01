<?php

namespace Tests\Feature\app\Models;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_model_of_order(): void
    {
        $order = Order::create([
            'amount' => 21.98,
            'sales_id' => 2,
            'status' => 1,
        ]);

        $this->assertDatabaseHas('orders', [
            'amount' => $order->amount,
            'sales_id' => $order->sales_id,
            'status' => $order->status,
        ]);
    }
}
