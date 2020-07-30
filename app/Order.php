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
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getSumOrder(){
        $sum = 0;
        foreach($this->products()->withTrashed()->get() as $product){
            $sum += $product->price * $product->pivot->count;
        }
        return $sum;
    }

    public function countOfProducts(){
        $count = 0;
        foreach($this->products->load('orders') as $product){
            $count+= $product->pivot->count;
        }
        if ($count > 0) {
            return "Count of products: " . $count;
        }
        else{
            return 'basked is empty';
        }

    }
    public function scopeActive($query){
        return $query->where('status', '=', 1);
    }
    public function ownerProductsSum(User $user)
    {
        $sum = 0;
        foreach($this->products()->withTrashed()->get() as $product){
            if ($user->products->contains($product))
            {
                $sum += $product->price * $product->pivot->count;
            }
        }
        return $sum;
    }
}
