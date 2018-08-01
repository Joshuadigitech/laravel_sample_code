<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskWorking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_working', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->date('day');
            $table->tinyInteger('is_break')->default(0);
            $table->time('start')->nullable();;
            $table->time('end')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_working');
    }
}
