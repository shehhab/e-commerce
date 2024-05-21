<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Product_detailsRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class Product_DetailsController extends Controller
{
    public function __invoke(Product_detailsRequest $request)
    {
        $validatedData = $request->validated();
        if (empty($validatedData['id'])) {
            return $this->handleResponse(status:false, message:'Please Enter Product_id',code : 404);
        }

        $product = Product::find($validatedData['id']);
        if (!$product) {
            return $this->handleResponse(status:false, message:'Product Not Found', code:404);
        }
        // Get the URL of the worker's profile image from the 'user_profile_image' collection

        // Format the Product data
        $formattedWorker = [
            'product_id' => $product->id,
            'name' => $product->name,
            'qty' => $product->qty,
            'description' => $product->description,
            'image' => asset('storage/' . $product->image), // Generate URL for the image
        ];

        return $this->handleResponse(status: true, data: $formattedWorker);
    }
}