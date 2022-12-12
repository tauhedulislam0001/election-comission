<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodFieldToCarBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_books', function (Blueprint $table) {
            $table->enum('payment_method', ['Wallet', 'Payment gateway'])->nullable();
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
            $table->dropColumn('payment_method');
        });
    }
}
