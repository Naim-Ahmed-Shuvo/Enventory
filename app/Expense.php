<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillabale = [
        'details',
        'amount',
        'month',
        'date',
    ];
}
