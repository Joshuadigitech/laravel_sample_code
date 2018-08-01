<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Allocation extends Model
{
    protected $table = 'task_allocation';

    /*
     *    To get Client Managers details
     */
    public function ManagerDetail()
    {
        return $this->hasOne('App\User', 'id', 'cm_id');
    }
    public function Task()
    {
        return $this->hasOne('App\Task', 'id', 'task_id');
    }
}
