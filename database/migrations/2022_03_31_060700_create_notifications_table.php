<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_request_id')->nullable();
            $table->unsignedBigInteger('wallet_deposite_id')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('status')->default(1)->comment('1 = show, 2 = mark_as_read');
            $table->timestamps();

            $table->foreign('agent_request_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('wallet_deposite_id')->references('id')->on('wallet_deposits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
