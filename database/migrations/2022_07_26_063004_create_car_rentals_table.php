<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('sp_id')->nullable();
            $table->unsignedBigInteger('sd_id')->nullable();
            $table->string('pickup_location');
            $table->string('pickup_date_time');
            $table->string('trip_duration');
            $table->string('trip_type');
            $table->string('car_name')->nullable();
            $table->string('car_type')->nullable();
            $table->string('fare')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('adb_pgw_subtotal')->default(0);
            $table->float('pgw_subtotal')->nullable();
            $table->string('status')->nullable();
            $table->string('full_name')->nullable();
            $table->string('pid_no')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('address')->nullable();
            $table->string('destination')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_mobile')->nullable();
            $table->string('driver_nid')->nullable();
            $table->string('car_no')->nullable();
            $table->string('channel');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('sd_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('sp_id')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_rentals');
    }
}
