<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded=[];

    public function cart()
	{
		return $this->belongsTo(Cart::class);
    }

    public function product()
	{
		return $this->belongsTo(Product::class);
    }

    public function getPrice(){
        return $this->price - $this->discount;
    }
}
