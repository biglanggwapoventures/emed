<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

            Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            // $table->string('clinic');
            // $table->string('clinic_address');
            // $table->string('specialization');
            // $table->string('clinic_hours');
            $table->string('ptr');
            $table->string('prc');
            $table->string('s2');
            $table->string('title');
            $table->string('med_school');
            $table->string('med_school_year');
            $table->string('residency');
            $table->string('residency_year');
            $table->string('training');
            $table->string('training_year');
            // $table->string('affiliations');
            // $table->string('subspecialty');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
