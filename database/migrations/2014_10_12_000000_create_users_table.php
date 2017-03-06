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
            $table->string('firstname');
            $table->string('middle_initial');
            $table->string('avatar')->default('default.jpg');
            $table->string('lastname');
            $table->string('sex');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->enum('user_type', [
                'ADMIN', 'DOCTOR', 'PMANAGER', 'PATIENT','PHARMA','SECRETARY'
            ]);
            $table->string('password');
            $table->string('address');
            $table->string('contact_number');
            $table->date('birthdate');
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
