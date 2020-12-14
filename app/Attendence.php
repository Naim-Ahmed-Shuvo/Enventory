<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
   protected $fillable = [
    'user_id',
    'date',
    'year',
    'attendence',
   ];
}
