<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
        'photo',
        'shop',
        'acc_holder',
        'acc_number',
        'bank_name',
        'brunch_name',
        'city',
    ];
}
