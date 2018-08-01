<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyHours extends Model
{
    protected $table = 'weeklyhours';
    protected $fillable = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',
    ];
    public $timestamps = false;
}
