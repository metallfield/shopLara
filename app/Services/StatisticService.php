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
        $products = $this->productRepository->getProductsByIds($keys) ;
        $sort = array_flip($keys);
        usort($products, function($a,$b) use($sort){
            return $sort[$a['id']] - $sort[$b['id']];
        });
//        foreach ($keys as $key)
//        {
//            $product[] = $this->productRepository->getProductById($key);
//            $product['countTrending'] = $count[$key];
//            $products[] = $product;
//        }
        return $products;
    }
    public function getProductStatistic()
   {
       $sum = $this->productRepository->getStatistic();
        $count = $this->productRepository->getProductsCount();
       return ['sum' => $sum, 'count' => $count];
   }
}
