<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncreaseDecreaseFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('increase_decrease_fares', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_type');
            $table->string('action_type');
            $table->string('amount_type');
            $table->integer('amount');
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
        Schema::dropIfExists('increase_decrease_fares');
    }
}
