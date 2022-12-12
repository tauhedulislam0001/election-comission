<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePaymentModeFieldIntoWalletDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_deposits', function (Blueprint $table) {
            \DB::statement("ALTER TABLE `wallet_deposits` CHANGE `payment_mode` `payment_mode` ENUM('Online Banking', 'Card (Prepaid/Debit)', 'Mmoney', 'Cash Deposit') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_deposits', function (Blueprint $table) {
            //
        });
    }
}
