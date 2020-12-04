<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'emp_id',
        'month',
        'year',
        'status',
        'adv_salary',
    ];
}
