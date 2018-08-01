<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('exp_level');
            $table->integer('services_type');
            $table->integer('number_of')->default();
            $table->text('skills');
            $table->integer('status');
            $table->integer('WeeklyHours_id')->nullable();
            $table->timestamps();
              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_request');
    }
}
