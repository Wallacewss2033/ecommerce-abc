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
        dd($this);
        $productJson = json_decode($this->productJson);
        return [
            "id" => $this->id,
            "price" => $this->price,
            "products" => new ProductResource($productJson)
        ];
    }
}
