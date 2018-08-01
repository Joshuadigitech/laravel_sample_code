<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->integer('is_description');
            $table->integer('comment_id');
            $table->string('file');
            $table->tinyInteger('is_deleted')->default(0);
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_media');
    }
}
