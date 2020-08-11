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

    public function getCategoriesStatistic()
    {
        $categories = Category::select('id', 'name')->with('products')->get();
        $result = [];
        foreach ($categories as $category)
        {

            $result[] = ['name'=> $category->name, 'countProducts' => $category->products->count() ];
        }

        return $result;
    }
}
