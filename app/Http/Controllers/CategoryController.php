<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }
    public function create(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string',
            'parent_category_id' => 'exists:categories,id',
        ]);

        // Creation de Categorie
        $category = Category::create($validatedData);

        return response()->json(['message' => 'Category created successfully']);
    }

    public function delete(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
