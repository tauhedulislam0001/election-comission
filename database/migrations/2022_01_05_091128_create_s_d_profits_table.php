<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSDProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_profits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sd_id');
            $table->string('car_name');
            $table->string('car_type');
            $table->double('inside_city');
            $table->double('outside_city');
            $table->double('status');
            $table->timestamps();

            $table->foreign('sd_id')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_d_profits');
    }
}
