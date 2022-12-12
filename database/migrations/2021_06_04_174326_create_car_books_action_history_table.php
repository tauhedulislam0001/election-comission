<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarBooksActionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_book_history', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("garibook_id");
            $table->string('action');
            $table->bigInteger('by_user');
            $table->mediumText('action_data');
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
        Schema::dropIfExists('car_book_history');
    }
}
