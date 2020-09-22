<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    protected $fillable = [
        'user_id',
        'user_email',
        'description',
        'name',
        'country',
        'address',
        'city',
        'state',
        'postcode',
        'phone'
    ];
}
