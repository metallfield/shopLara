<?php


namespace App\Repositories;


use App\Category;
use App\Product;
use App\User;

class ProductRepository
{
    public function getAllProducts(?User $user = null)
    {
        $query = Product::with('categories', 'user');
        if($user !== null) {
            $query->where('user_id', $user->id);
        }
        return $query->paginate(9);
    }
    public function getRecommendProducts(Product $product)
    {
        $category = $product->categories->first();
        return $category->products->load('categories') ? $category->products->take(3) : null ;
    }
    public function getAllProductsForFilter()
    {
        return Product::with('categories');
    }
    public function getForSearch($query)
    {
        return Product::with('categories')->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')->paginate(6);
    }

    public function getProductById($id)
    {
        return Product::with('markets')->where('id', $id)->first();
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
            return Product::find($product)->categories()->attach($category);
        }
    }

    public function updateProduct($data, $product)
    {
        if ($product->update($data))
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function getPriceForCount(Product $product)
    {
        if (!is_null($product->pivot)) {
            return $product->pivot->count * $product->price;
        }
        return $product->price;
    }
}
