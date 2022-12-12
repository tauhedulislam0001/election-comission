<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePGCurrencyConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_g_currency_conversions', function (Blueprint $table) {
            $table->id();
            $table->char('base_currency', 255);
            $table->char('converted_currency', 255);
            $table->double('conversion_rate');
            $table->integer('status');
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
        Schema::dropIfExists('p_g_currency_conversions');
    }
}
