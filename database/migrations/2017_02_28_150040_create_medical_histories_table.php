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
            $table->string('pulserate')->nullable();
            $table->string('resprate')->nullable();
            $table->string('notes');
            $table->string('chiefcomplaints');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');


            $table->string('allergyquestion')->nullable();
            $table->string('allergyname')->nullable();
            $table->string('past_surgery')->nullable();
            $table->string('immunization')->nullable();
            $table->string('past_disease')->nullable();
            $table->string('family_history')->nullable();


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
