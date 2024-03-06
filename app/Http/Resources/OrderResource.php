<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productJson = json_decode($this->resource->productJson);
        return [
            "id" => $this->id,
            "price" => $this->price,
            "products" => new ProductResource($productJson)
        ];
    }
}
