<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionProfitsActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_profits_activities', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('sd_id')->nullable();
            $table->string('agent_commission')->nullable();
            $table->string('sd_profit')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('commission_profits_activities');
    }
}
