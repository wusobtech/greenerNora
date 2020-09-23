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
        $price_= ($this->price * $this->quantity);
        $disc_ = ($this->discount * $this->quantity);
        return $price_ - $disc_;
    }
}
