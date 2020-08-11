<?php


namespace App\Services;


use App\Repositories\CategoriesRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;

class StatisticService
{

    /**
     * @var \App\Repositories\ProductRepository
     */
    private $productRepository;
    /**
     * @var \App\Repositories\OrderRepository
     */
    private $orderRepository;
    /**
     * @var \App\Repositories\CategoriesRepository
     */
    private $categoriesRepository;

    public function __construct()
    {
        $this->productRepository = app(ProductRepository::class);
        $this->orderRepository = app(OrderRepository::class);
        $this->categoriesRepository = app(CategoriesRepository::class);
    }

    public function getMostTrendingProduct(){
        $mostSails = $this->productRepository->getMostTrendingProduct();
        $mostSailsArray = [];
        foreach ($mostSails as $ms)
        {
            $mostSailsArray[] = $ms->product_id;
        }
        $count=array_count_values($mostSailsArray);
        arsort($count);
        $keys = array_keys($count);
        $keys = array_slice($keys, 0,10);
        $products = $this->productRepository->getProductsByIds($keys) ;
        $sort = array_flip($keys);
        usort($products, function($a,$b) use($sort){
            return $sort[$a['id']] - $sort[$b['id']];
        });

        return [$products, 'count'=> $count];
    }
    public function getProductStatistic()
   {
       $sum = $this->productRepository->getStatistic();
        $count = $this->productRepository->getProductsCount();
       return ['sum' => $sum, 'count' => $count];
   }

   public function getOrdersStatistic()
   {
       return $this->productRepository->getOrdersStatistic();
   }
   public function getTotalOrdersSum()
   {
       $price = $this->orderRepository->getTotalOrdersSum();
       $count = $this->orderRepository->getCountOfOrders();
       return ['price' => $price, 'count' => $count];
   }

   public function getCategoriesStatistic()
   {
       return $this->categoriesRepository->getCategoriesStatistic();

   }
}
