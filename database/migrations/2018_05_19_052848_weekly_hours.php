<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WeeklyHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::create('WeeklyHours', function (Blueprint $table) {
            $table->increments('id');
           $table->Integer('Monday')->nullable();
           $table->Integer('Tuesday')->nullable();
           $table->Integer('Wednesday')->nullable();
           $table->Integer('Thursday')->nullable();
           $table->Integer('Friday')->nullable();
           $table->Integer('Saturday')->nullable();          
        
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
  public function down()
    {
        Schema::dropIfExists('WeeklyHours');
    }
}

