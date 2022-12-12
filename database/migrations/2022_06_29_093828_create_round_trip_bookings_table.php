<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundTripBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('round_trip_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('trip_type');
            $table->unsignedBigInteger('sd_id');
            $table->string('car_name');
            $table->string('car_type');
            $table->string('airport_name');
            $table->string('division_name')->nullable();
            $table->string('district_name')->nullable();
            $table->string('thana_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('street_address')->nullable();
            $table->string('village_name')->nullable();
            $table->string('pickup_date_time');
            $table->string('return_date_time');
            $table->string('full_name');
            $table->string('passport_no')->nullable();
            $table->string('nationality')->nullable();
            $table->string('phone_no');
            $table->string('email');
            $table->string('departure_airport');
            $table->string('airlines_name')->nullable();
            $table->string('flight_number');
            $table->string('emergency_contact')->nullable();
            $table->string('status');
            $table->string('payment_method');
            $table->string('payment_status')->nullable();
            $table->float('fare');
            $table->float('discount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->float('subtotal');
            $table->float('pgw_subtotal')->nullable();
            $table->float('adb_pgw_subtotal')->default(0);
            $table->float('bdt_fare')->default(0);
            $table->float('vendor_sale')->default(0);
            $table->float('payment_recieved_bdt')->default(0);
            $table->float('gb_profit')->default(0);
            $table->unsignedBigInteger('service_provider')->nullable();
            $table->unsignedBigInteger('agent_commission_profit_id')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_mobile')->nullable();
            $table->string('driver_nid')->nullable();
            $table->string('car_no')->nullable();
            $table->string('channel');
            $table->timestamps();

            $table->foreign('sd_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('service_provider')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('agent_commission_profit_id')->references('id')->on('commission_profits_activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('round_trip_bookings');
    }
}
