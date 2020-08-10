<?php


namespace App\Services;


use App\Order;
use App\Product;
use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class Basket
{
    private $order;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(User $user ,$createOrder = false){
        $this->orderRepository = app(OrderRepository::class);
        $orderId = session('orderId');
        if(is_null($orderId) && $createOrder){
            $data = [];
            if (isset($user)) {
                $data['user_id'] = $user->id;
            }
            $this->order = $this->orderRepository->create($data);
            session(['orderId' => $this->order->id]);
        }else{
            $this->order= $this->orderRepository->findOrder($orderId);
        }

    }

    public function getOrder(){
        return $this->order ? $this->order : null;
    }
    protected function getPivot($product){
        return  $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function countAvailable(){
        foreach ($this->order->products as $orderProduct) {
            if($orderProduct->count < $this->getPivot($orderProduct)->count)
                return false;
        }
        return true;
    }
    protected function changeCount(){
        foreach ($this->order->products as $orderProduct) {
            $res = $orderProduct->count -  $this->getPivot($orderProduct)->count;
            $orderProduct->update(['count' => $res]);
        }
    }

    public function SaveOrder($name, $address, $email ,$shipping = null, $order_id){
        if (!$this->countAvailable()) {
            return false;
        }
        $this->changeCount();
        return $this->orderRepository->saveOrder($name, $address, $email, $shipping, $order_id);
    }

    public function removeProduct(Product $product){
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivot($product);
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id);

            } else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        return true;
    }

    public function addProduct(Product $product){
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivot($product);
            $pivotRow->count++;
            if ($pivotRow->count > $product->count) {
                return false;
            }
            $pivotRow->update();
        } else{
            if ($product->count     == 0) {
                return false;
            }
            $this->order->products()->attach($product->id);
        }

        return true;
    }
}
