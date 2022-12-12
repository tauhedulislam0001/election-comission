<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('singletrip_booking_id')->nullable();
            $table->unsignedBigInteger('roundtrip_booking_id')->nullable();
            $table->unsignedBigInteger('multicity_booking_id')->nullable();
            $table->unsignedBigInteger('car_rental_booking_id')->nullable();
            $table->integer('sd_id');
            $table->integer('booked_by');
            $table->float('agent_commission');
            $table->float('sd_profit');
            $table->float('gb_profit');
            $table->float('sale_price');
            $table->string('currency');
            $table->string('country');
            $table->float('discount')->nullable();
            $table->float('total_sale_price');
            $table->float('total_bd_price')->nullable();
            $table->float('total_cost')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('singletrip_booking_id')->references('id')->on('single_trip_bookings')->onDelete('cascade');
            $table->foreign('roundtrip_booking_id')->references('id')->on('round_trip_bookings')->onDelete('cascade');
            $table->foreign('multicity_booking_id')->references('id')->on('multi_city_trip_bookings')->onDelete('cascade');
            $table->foreign('car_rental_booking_id')->references('id')->on('car_rentals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_reports');
    }
}
