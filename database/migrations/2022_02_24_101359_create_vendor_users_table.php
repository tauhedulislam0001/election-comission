<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_users', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_type')->comment('1 = single_trip_fare, 2 = round_trip_fare');
            $table->string('fullname');
            $table->string('email')->unique()->nullable();
            $table->integer('mobile')->unique();
            $table->string('airport_name');
            $table->string('division_name');
            $table->string('district_name');
            $table->string('address');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('vendor_users');
    }
}
