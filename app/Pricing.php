<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
     protected $table = 'pricing';
     protected $fillable = [
        'exp_level_id','price','start_date','end_date'
    ];
}
