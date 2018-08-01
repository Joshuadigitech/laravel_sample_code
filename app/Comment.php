<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    public $timestamps = false;

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'comment_by');
    }
}
