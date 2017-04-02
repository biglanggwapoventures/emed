<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPharmacyIdAndBranchToPharmacyManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_managers', function (Blueprint $table) {
            $table->unsignedInteger('pharmacy_id')->nullable();
            $table->unsignedInteger('pharmacy_branch_id')->nullable();

            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('set null');
            $table->foreign('pharmacy_branch_id')->references('id')->on('pharmacy_branches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_managers', function (Blueprint $table) {
            $table->dropForeign(['pharmacy_id']);
            $table->dropForeign(['pharmacy_branch_id']);
            $table->dropColumns(['pharmacy_id', 'pharmacy_branch_id']);
        });
    }
}
