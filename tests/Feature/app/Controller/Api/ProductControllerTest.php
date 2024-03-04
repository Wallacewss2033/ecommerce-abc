<?php

namespace Tests\Feature\app\Controller\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_endpoint_list_of_products(): void
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                "current_page",
                "data",
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "links",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total",
            ]);
    }
}
