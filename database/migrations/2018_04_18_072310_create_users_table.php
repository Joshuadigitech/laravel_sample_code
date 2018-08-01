<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //personal Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email' , '60')->unique();
            $table->string('password');
            $table->string('gender', '10')->nullable();
            $table->integer('role_id');
            $table->string('avatar')->nullable();            
            //contact Info
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();

            $table->date('joining_date');
            //Other Requirement
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->string('exp_level')->nullable();
            $table->text('bio')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
