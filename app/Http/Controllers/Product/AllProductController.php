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
 

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $product->qty,
                'description' => $product->description,
                'image' => asset('storage/' . $product->image), // Generate URL for the image
                
            ];
        });

        return $this->handleResponse(data : $products);
}
}
