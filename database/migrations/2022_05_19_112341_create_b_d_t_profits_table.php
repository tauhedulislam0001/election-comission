<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBDTProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_d_t_profits', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->string('car_type');
            $table->string('trip_type');
            $table->double('inside_city_amount');
            $table->double('outside_city_amount');
            $table->double('status');
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
        Schema::dropIfExists('b_d_t_profits');
    }
}
