<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = ['user_id'];
    public function  products(){
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getSumOrder(){
        $sum = 0;
        foreach($this->products()->withTrashed()->get() as $product){
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }
    public static function changeFullSum($changeSum){
        $sum = self::getFullPrice() + $changeSum;
        session(['full_order_sum' => $sum]);
    }
    public static function eraseOrderSum(){
        session()->forget('full_order_sum');
    }
    public static function getFullPrice(){

        return session('full_order_sum', 0);
    }
    public function countOfProducts(){
        $count = 0;
        foreach($this->products as $product){
            $count+= $product->countProduct();
        }
        if ($count > 0) {
            return "Count of products: " . $count;
        }
        else{
            return 'basked is empty';
        }

    }
    public function saveOrder($name, $address, $email, $shipping = null){
        if ($this->status == 0) {
            $this->name = $name;
            $this->address = $address;
            $this->email = $email;
            $this->shipping_address =  $shipping ? $shipping : null;
            $this->user_id = Auth::id();
            $this->status = 1;
            $this->save();
            session()->forget('orderId');

            return true;
        }else{
            return false;
        }

    }
    public function scopeActive($query){
        return $query->where('status', '=', 1);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ownerProductsSum()
    {
        $sum = 0;
        foreach($this->products()->withTrashed()->get() as $product){
            if (Auth::user()->products->contains($product))
            {
                $sum += $product->getPriceForCount();
            }
        }
        return $sum;
    }
}
