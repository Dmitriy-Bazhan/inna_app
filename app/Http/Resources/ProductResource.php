<?php

namespace App\Http\Resources;

use App\Models\ProductData;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'vendor_code' => $this->vendor_code,
            'alias' => $this->alias,
            'search_string' => $this->search_string,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image_big' => $this->image_big,
            'image_small' => $this->image_small,
            'additional_images' => $this->additional_images,
            'published' => $this->published,
            'data' => $this->data,
        ];
    }
}
