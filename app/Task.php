<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    /*
     *    To get allocated manager to the task
     */
    public function allocateTo()
    {
        return $this->hasOne('App\Task_Allocation', 'task_id', 'id');
    }

    public function Project()
    {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }

    public function Task_Allocation()
    {
        return $this->hasOne('App\Task_Media', 'Task_id', 'id');
    }

}
