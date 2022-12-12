<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_fares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->integer('fare_type')->comment('1 = single_trip_fare, 2 = round_trip_fare, 3 = multicity_trip_fare', );
            $table->string('airport_name');
            $table->string('division_name');
            $table->string('district_name');
            $table->string('thana_name');
            $table->string('note')->nullable();
            $table->float('regular_sedan_fare');
            $table->float('standard_sedan_fare');
            $table->float('premium_sedan_fare')->nullable();
            $table->float('regular_noah_fare');
            $table->float('standard_noah_fare');
            $table->float('premium_noah_fare')->nullable();
            $table->float('regular_hiace_fare');
            $table->float('standard_hiace_fare');
            $table->float('premium_hiace_fare')->nullable();
            $table->integer('status')->default(0)->comment('0 = inactive, 1 = active');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendor_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_fares');
    }
}
