<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pricing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exp_level_id')->unsigned(); 
            $table->integer('price');     
            $table->date('start_date');
            $table->date('end_date')->nullable();
        });
       Schema::table('pricing', function ($table) {      
            $table->foreign('exp_level_id')
            ->references('id')->on('exp_level')
            ->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricing');
    }
}
