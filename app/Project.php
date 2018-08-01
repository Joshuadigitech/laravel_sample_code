<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    public function Task()
    {
        return $this->hasMany('App\Task', 'project_id', 'id');
    }

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'client_id');
    }
}

// public function getStartAttribute($value)
// {
//     //$value = $value->format('d-m-Y');
//     return ucfirst($value);
// }
