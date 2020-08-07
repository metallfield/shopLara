<?php


namespace App\Services;


use App\Repositories\ProductRepository;

class StatisticService
{

    /**
     * @var \App\Repositories\ProductRepository
     */
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = app(ProductRepository::class);
    }

    public function getMostTrendingProduct(){
        $mostSails = $this->productRepository->getMostTrendingProduct();
        $mostSailsArray = [];
        foreach ($mostSails as $ms)
        {
            $mostSailsArray[] = $ms->product_id;
        }
        $count=array_count_values($mostSailsArray);//Counts the values in the array, returns associatve array
        arsort($count);//Sort it from highest to lowest
        $keys = array_keys($count);
        $products = [];
        $product= [];
        foreach ($keys as $key)
        {
            $product[] = $this->productRepository->getProductById($key);
            $product['countTrending'] = $count[$key];
            $products[] = $product;
        }
        return $products;
    }
    public function getProductStatistic()
   {
       $sum = 0;
       $products = $this->productRepository->getStatistic();
        foreach ($products as $product)
       {
           $sum += $product->price;
       }
       return ['sum' => $sum, 'count' => $products->count()];
   }
}
