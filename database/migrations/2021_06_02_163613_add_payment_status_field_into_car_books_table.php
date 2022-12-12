<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStatusFieldIntoCarBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_books', function (Blueprint $table) {
            $table->enum('payment_status', ['Due', 'Paid'])->default('Due');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_books', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
}
