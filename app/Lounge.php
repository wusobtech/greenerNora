<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lounge extends Model
{
    protected $guarded=[];

    public function category()
	{
		return $this->belongsTo(ProductCategory::class);
    }

    public function getImage(){
        return $this->productImagePath.'/'.$this->image;
    }

    public function getPrice(){
        return $this->price - $this->discount;
    }
}
