<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDivisionDistrictColumnsIntoSingleTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('single_trips', function (Blueprint $table) {
            // $table->string('division_name')->nullable();
            // $table->string('district_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('single_trips', function (Blueprint $table) {
            $table->dropColumn('division_name');
            $table->dropColumn('district_name');
        });
    }
}