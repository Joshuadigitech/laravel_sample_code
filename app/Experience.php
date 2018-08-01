<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'exp_level';
     public function pricing()
    {
        return $this->hasOne('App\Pricing', 'exp_level_id', 'id');
    }
}
