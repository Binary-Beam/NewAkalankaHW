<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new instance of the category model with the validated data
        $category = new Category();
        $category->name = $validatedData['name'];


        // Save the category
        $category->save();

        // Return a response
        return response()->json(['message' => 'category created successfully', 'category' => $category], 201);
    }
}
