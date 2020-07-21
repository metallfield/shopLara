<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isAddedProduct($id)
    {
        $productArr = [];
        foreach ($this->products as $product) {
            $productArr[] = $product->id;
        }
        if (in_array($id, $productArr))
        {
            return true;
        }else{
            return  false;
        }
    }
}
