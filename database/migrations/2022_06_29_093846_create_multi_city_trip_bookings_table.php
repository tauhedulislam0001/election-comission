<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiCityTripBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_city_trip_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('created_by');

            $table->string('car_name');
            $table->string('car_type');
            $table->string('emergency_contact')->nullable();
            $table->unsignedBigInteger('sd_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->longText('form');
            $table->longText('form1')->nullable();
            $table->longText('form2')->nullable();
            $table->longText('form3')->nullable();
            $table->longText('form4')->nullable();
            $table->string('full_name');
            $table->integer('no_of_passenger')->nullable();
            $table->string('pid_no')->nullable();
            $table->string('nationality')->nullable();
            $table->string('phone_no');
            $table->string('email');
            $table->string('status');
            $table->string('payment_method');
            $table->string('payment_status')->default('Due');
            $table->float('fare');
            $table->float('discount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->float('subtotal');
            $table->float('pgw_subtotal')->nullable();
            $table->unsignedBigInteger('service_provider')->nullable();
            $table->longText('driver_information')->nullable();
            $table->string('channel');
            $table->timestamps();            
            
            $table->foreign('sd_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('service_provider')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multi_city_trip_bookings');
    }
}
