<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePGBKashSuccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_g_b_kash_success_logs', function (Blueprint $table) {
            $table->id();
            $table->string('bookingID');
            $table->string('customerMsisdn');
            $table->string('amount');
            $table->string('currency');
            $table->string('trxID');
            $table->string('paymentID');
            $table->string('intent');
            $table->string('transactionStatus');
            $table->timestamps();
            
            $table->foreign('bookingID')->references('booking_id')->on('car_books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_g_b_kash_success_logs');
    }
}
