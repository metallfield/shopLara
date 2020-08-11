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


    public function scopeActive($query){
        return $query->where('status', '=', 1);
    }

}
