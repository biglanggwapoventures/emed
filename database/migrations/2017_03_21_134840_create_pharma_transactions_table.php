<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharma_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('brand');
            $table->string('genericname');
            $table->integer('quantity');
            $table->string('dosage');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('pharma_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('pharma_id')->references('id')->on('pharmacists');
        });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharma_transactions');
    }
}
