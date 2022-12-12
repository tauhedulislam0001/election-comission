<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePGNagadErrorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_g_nagad_error_logs', function (Blueprint $table) {
            $table->id();
            $table->string('orderId')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('paymentRefId')->nullable();
            $table->string('amount')->nullable();
            $table->string('clientMobileNo')->nullable();
            $table->string('orderDateTime')->nullable();
            $table->string('issuerPaymentDateTime')->nullable();
            $table->string('issuerPaymentRefNo')->nullable();
            $table->string('status')->nullable();
            $table->string('statusCode')->nullable();
            $table->string('cancelIssuerDateTime')->nullable();
            $table->string('cancelIssuerRefNo')->nullable();
            $table->string('serviceType')->nullable();
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
        Schema::dropIfExists('p_g_nagad_error_logs');
    }
}
