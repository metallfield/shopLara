<?php


namespace App\Repositories;


use App\Category;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        if ($product->categories->load('products')->count() > 0)
        {
            $category = $product->categories->first();
            return  $category->products->load('categories')->take(3);
        }
        return null;

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
        $category = Category::where('id', $category)->select('id')->first();
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

    public function getStatistic()
    {

        return Product::select('price')->where('count', '>', '0')->sum('price');
    }
    public function getProductsCount(){
        return Product::count();
    }
    public function getProductsByIds($ids)
    {
        return Product::find($ids)->all();
    }
    public function getMostTrendingProduct()
    {
       return DB::table('order_product')->select('product_id')->get();
    }

    public function getOrdersStatistic()
    {
        return  Order::select('created_at')->get()->map(function($item) {
            $item->day = $item->created_at->day;
            $item->month = $item->created_at->month;
            return $item;
        })
            ->groupBy(['month', 'day'])
            ->map
            ->map(function($day) {
                return $day->count();
            });
    }
}
