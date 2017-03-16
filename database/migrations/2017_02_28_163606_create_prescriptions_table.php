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
            $table->string('frequency');
            $table->date('start');
            $table->date('end');
            $table->string('dosage');
            $table->unsignedInteger('user_id');
             $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
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
        Schema::dropIfExists('prescriptions');
    }
}
