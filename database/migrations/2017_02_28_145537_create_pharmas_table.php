<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('manager_id');
            $table->string('license');

            $table->unsignedInteger('drugstore');
            $table->unsignedInteger('drugstore_branch');

            $table->timestamps();
           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('pharmacy_managers')->onDelete('cascade');
            $table->foreign('drugstore')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->foreign('drugstore_branch')->references('id')->on('pharmacy_branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmas');
    }
}
