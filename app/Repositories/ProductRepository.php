<?php


namespace App\Repositories;


use App\Category;
use App\Product;
use App\User;

class ProductRepository
{
    public function getAllProducts(?User $user = null)
    {
        $query = Product::with('categories', 'user')->orderBy('updated_at', 'desc');
        if($user !== null) {
            $query->where('user_id', $user->id);
        }
        return $query->paginate(6);
    }
    public function getAllProductsForFilter()
    {
        return Product::with('categories')->orderBy('updated_at', 'desc');
    }
    public function getForSearch($query)
    {
        return Product::with('categories')->where('name', 'LIKE', '%' . $query . '%')->paginate(6);
    }

    public function getProductById($id)
    {
        return Product::where('id', $id)->first();
    }
    public function storeProduct($data)
    {
        $product = Product::create($data)->id;
        if ($product)
        {
            return $product;
        }else{
            return null;
        }
    }
    public function attachCategory($product,  $category)
    {

        $category = Category::where('name', $category)->select('id')->first();
        if ($category)
        {
             Product::find($product)->categories()->attach($category);
             return true;
        }
    }

    public function updateProduct($data, $product)
    {
        if ($product->update($data))
        {
            return true;
        }
        else{
            return null;
        }
    }
}
