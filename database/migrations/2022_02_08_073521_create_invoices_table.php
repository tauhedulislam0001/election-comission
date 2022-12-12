<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->char('invoice_no');
            $table->unsignedBigInteger('sd_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('credit_note_id');
            $table->float('amount');    
            $table->string('currency'); 
            $table->string('booking_date'); 
            $table->integer('status');
            $table->timestamps();

            $table->foreign('sd_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('car_books')->onDelete('cascade');
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
        Schema::dropIfExists('invoices');
    }
}
