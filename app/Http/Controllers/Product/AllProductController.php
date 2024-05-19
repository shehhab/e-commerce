<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllProductController extends Controller
{
    public function __invoke()
    {
        $products = Product::with('media')->get()->map(function ($product) {
            $images = $product->getMedia('product_image')->map(function ($media) {
                return [
                    'original_url' => $media->getUrl(),
                ];
            });

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
                'images' => $images
            ];
        });

        return $this->handleResponse(data : $products);
}
}
