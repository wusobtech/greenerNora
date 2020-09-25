<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];

    public function user()
	{
		return $this->belongsTo(User::class);
    }

    public function payment()
	{
		return $this->belongsTo(Payment::class);
    }

    public function orders(){
        return $this->hasMany('App\OrderItem','order_id');
    }

    public static function getOrderDetails($order_id){
        $getOrderDetails = Order::where('id',$order_id)->first();
        return $getOrderDetails;
    }

    public static function getCountryCode($country){
        $getCountryCode = Country::where('name', $country)->first();
        return $getCountryCode;
    }
}
