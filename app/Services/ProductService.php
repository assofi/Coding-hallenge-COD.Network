<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('products', 'public');
            $data['image'] = $imagePath;
        }

        return Product::create($data);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
    }

    public function filterByCategory($categoryId)
    {
        return Product::where('category_id', $categoryId)->get();
    }

    public function sortBy($by)
    {
        return Product::orderBy($by)->get();
    }

  }

