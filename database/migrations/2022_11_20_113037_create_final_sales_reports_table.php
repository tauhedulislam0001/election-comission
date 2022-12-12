<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalSalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_sales_reports', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->integer('sd_id');
            $table->integer('booked_by');
            $table->float('fare')->nullable();
            $table->float('discount_amount')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('vendor_sale')->nullable();
            $table->float('agent_commission');
            $table->float('sd_profit');
            $table->string('cp_status')->nullable();
            $table->float('operator_charge')->nullable();
            $table->float('gb_profit')->nullable();
            $table->string('country');
            $table->string('booking_status');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('status');
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
        Schema::dropIfExists('final_sales_reports');
    }
}
