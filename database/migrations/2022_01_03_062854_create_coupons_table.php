<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('coupon_code')->unique();
            $table->integer('coupon_type')->comment('1 = one-time, 2 = campaign');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('amount');
            $table->string('country');
            $table->integer('flag')->nullable();
            $table->integer('status')->comment('1 = active, 2 = inactive, 3 = expired');
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
