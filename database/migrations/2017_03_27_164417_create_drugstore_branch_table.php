<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugstoreBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugstore_branch', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('drugstore_id');
            $table->string('branch');
            $table->timestamps();

            $table->foreign('drugstore_id')->references('id')->on('drugstores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugstore_branch');
    }
}
