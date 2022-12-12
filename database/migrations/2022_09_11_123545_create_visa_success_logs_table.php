<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaSuccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_success_logs', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('transactionStatus')->nullable();
            $table->string('authCode')->nullable();
            $table->string('postData')->nullable();
            $table->string('transactionReferenceID')->nullable();
            $table->string('marchTrackID')->nullable();
            $table->string('transactionID')->nullable();
            $table->string('transactionAmount')->nullable();
            $table->string('ECI')->nullable();
            $table->string('cardNumber')->nullable();
            $table->string('issuerResponseCode')->nullable();
            $table->string('getUdf1')->nullable();
            $table->string('getUdf2')->nullable();
            $table->string('getUdf3')->nullable();
            $table->string('getUdf4')->nullable();
            $table->string('getUdf5')->nullable();
            $table->string('getUdf6')->nullable();
            $table->string('getUdf7')->nullable();
            $table->string('getUdf8')->nullable();
            $table->string('getUdf9')->nullable();
            $table->string('getUdf10')->nullable();
            $table->string('getUdf11')->nullable();
            $table->string('getUdf12')->nullable();
            $table->string('getUdf14')->nullable();
            $table->string('getUdf15')->nullable();
            $table->string('paymentID')->nullable();
            $table->string('customerID')->nullable();            
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
        Schema::dropIfExists('visa_success_logs');
    }
}
