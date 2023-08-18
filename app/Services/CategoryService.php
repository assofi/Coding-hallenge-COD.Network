<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

}
