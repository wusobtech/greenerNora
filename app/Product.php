<?php

namespace App;

use App\Traits\Constants;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Constants;

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
