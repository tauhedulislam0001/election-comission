<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletDeposits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sd_id');
            $table->unsignedBigInteger('user_type_id');
            $table->unsignedBigInteger('credit_note_id');
            $table->string('payment_mode');
            $table->string('trans_ref', 30)->nullable();
            $table->date('deposit_date');
            $table->decimal('amount', 8, 2);
            $table->float('amount_recieved');
            $table->string('currency');
            $table->char('remarks');
            $table->string('status');
            $table->string('attachment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('sd_id')->references('created_by')->on('admin_users')->onDelete('cascade');
            $table->foreign('user_type_id')->references('user_type')->on('admin_users')->onDelete('cascade');
            $table->foreign('credit_note_id')->references('id')->on('credit_notes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_deposits');
    }
}
