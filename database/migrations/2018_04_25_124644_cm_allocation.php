<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmAllocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('resource_allocation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('cm_id');
            $table->integer('services_id');
            $table->integer('resource_allocation_id');            
            $table->boolean('is_activated')->default(true);
            $table->date('allocation_date');
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
        Schema::dropIfExists('resource_allocation');
    }
}
