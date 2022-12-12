<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('agent_id');
            $table->enum('trans_type', ['credit', 'debit']);

            // transaction type reference model. This is the chart of account the transaction happen. for example deposit, value would be headsable ="App\Deposit" and heads_id=deposit_id
            $table->morphs('head');
            $table->decimal('amount', 8,2);
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('wallet_ledgers');
    }
}
