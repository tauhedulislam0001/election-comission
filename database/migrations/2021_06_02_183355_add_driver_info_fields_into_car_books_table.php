<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverInfoFieldsIntoCarBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_books', function (Blueprint $table) {
            $table->string('driver_name')->nullable();
            $table->string('driver_mobile')->nullable();
            $table->string('driver_nid')->nullable();
            $table->string('car_no')->nullable();
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
            $table->dropColumn('driver_name');
            $table->dropColumn('driver_mobile');
            $table->dropColumn('driver_nid');
            $table->dropColumn('car_no');
        });
    }
}
