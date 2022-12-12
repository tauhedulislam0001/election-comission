<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_fares', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_type');
            $table->string('date');
            $table->string('event_name');
            $table->string('increase_type');
            $table->string('car_name');
            $table->string('car_type');
            $table->float('inside_city_amount');
            $table->float('outside_city_amount');
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
        Schema::dropIfExists('holiday_fares');
    }
}
