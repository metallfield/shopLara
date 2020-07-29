<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use softDeletes;
    protected $fillable = ['name', 'description', 'price', 'image', 'count','user_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function markets()
    {
        return $this->belongsToMany(Market::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function isAvaible(){

        return $this->count > 0 && !$this->trashed();
    }
}
