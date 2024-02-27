<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Ensure category_id exists in categories table
            // Add more validation rules as needed
        ]);

        // Create a new instance of the Product model with the validated data
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->category_id = $validatedData['category_id'];
        // Assign other fields if needed

        // Save the product
        $product->save();

        // Return a response
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }
}
