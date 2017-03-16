<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('bloodtype');
            $table->string('econtact');
            $table->string('enumber');
            $table->string('nationality');
            $table->string('civilstatus');
            $table->string('erelationship');
            $table->string('occupation');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            
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
        Schema::dropIfExists('patients');
    }
}
