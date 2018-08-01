<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'user1',
        'user2',
    ];
    public $timestamps = false;

    public function userB()
    {
        return $this->hasOne('App\User', 'id', 'user2');
    }
    public function userA()
    {
        return $this->hasOne('App\User', 'id', 'user1');
    }

}
