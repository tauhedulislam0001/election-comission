<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkashRefundSuceessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkash_refund_suceess_logs', function (Blueprint $table) {
            $table->id();
            $table->string('completedTime');
            $table->string('transactionStatus');
            $table->string('originalTrxID');
            $table->string('refundTrxID');
            $table->float('amount');
            $table->string('currency');
            $table->float('charge');
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
        Schema::dropIfExists('bkash_refund_suceess_logs');
    }
}
