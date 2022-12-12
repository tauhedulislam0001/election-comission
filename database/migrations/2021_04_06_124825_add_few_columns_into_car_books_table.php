<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFewColumnsIntoCarBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_books', function (Blueprint $table) {
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            $table->string('nationality')->nullable();
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
            $table->dropColumn('children');
            $table->dropColumn('infants');
            $table->dropColumn('nationality');
        });
    }
}
