<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubSpecializationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_specializations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('specialization_id');
            $table->string('sub_specialization');
            $table->timestamps();

            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('sub_specialization');
    }
}
