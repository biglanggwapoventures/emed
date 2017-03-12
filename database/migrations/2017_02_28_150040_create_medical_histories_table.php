<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            // $table->unsignedInteger('user_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->string('weight');
            $table->string('height');
            $table->string('bloodpressure');
            $table->string('temperature');
            $table->string('pulserate');
            $table->string('resprate');
            $table->string('patientnote');
            $table->string('allergyname');
            $table->string('allergyquestion');
            $table->string('pastsakit');
            $table->string('immunization');
            $table->string('surgeryprocedure');
            $table->string('notes');
            $table->string('chiefcomplaints');
            $table->string('medications');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
}
