<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('brand');
            $table->string('genericname');
            $table->integer('quantity');
            $table->integer('duration');
            $table->string('frequency');
            $table->date('start');
            $table->date('end');
            $table->string('dosage');
            $table->string('notes');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('consultation_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('consultation_id')->references('id')->on('medical_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
