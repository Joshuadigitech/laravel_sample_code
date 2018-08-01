<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_company', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('company_name');
            $table->string('company_phone');
            $table->string('company_address');
            $table->integer('company_zip');
            $table->string('company_country');
            $table->integer('no_of_employees');
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
        Schema::dropIfExists('client_company');
    }
}
