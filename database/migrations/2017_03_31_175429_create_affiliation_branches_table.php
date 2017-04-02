<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliationBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliation_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('affiliation_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('affiliation_id')->references('id')->on('affiliations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliation_branches');
    }
}
