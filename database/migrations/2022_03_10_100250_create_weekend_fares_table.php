<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekendFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekend_fares', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_type');
            $table->string('day');
            $table->string('increase_type');
            $table->string('car_name');
            $table->string('car_type');
            $table->float('insite_city_amount');
            $table->float('outsite_city_amount');
            $table->integer('amount');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekend_fares');
    }
}
