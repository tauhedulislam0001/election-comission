<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_fares', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_type');
            $table->string('car_name');
            $table->string('car_type');
            $table->string('country');
            $table->string('currency');
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
        Schema::dropIfExists('profit_fares');
    }
}
