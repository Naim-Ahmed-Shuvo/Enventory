<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cat_id',
        'p_name',
        'sup_id',
        'p_code',
        'p_garage',
        'p_route',
        'p_image',
        'buy_date',
        'expire_date',
        'selling_price',
        'buying_price',
    ];
}
