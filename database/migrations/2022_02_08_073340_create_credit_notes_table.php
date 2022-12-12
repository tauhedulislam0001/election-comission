<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->id();
            $table->char('credit_no');
            $table->unsignedBigInteger('sd_id');
            $table->string('currency');
            $table->float('amount');
            $table->float('due_amount')->nullable();
            $table->integer('status')->comment('0 = pending, 1 = due, 2 = reject, 3 = compelete');
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
        Schema::dropIfExists('credit_notes');
    }
}
