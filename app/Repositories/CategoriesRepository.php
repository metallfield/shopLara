<?php


namespace App\Repositories;


use App\Category;

class CategoriesRepository
{
    public function getAllCategories()
    {
        return Category::with('products')->paginate(6);
    }

    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function editCategory($data, $category)
    {
        return $category->update($data);
    }
}
