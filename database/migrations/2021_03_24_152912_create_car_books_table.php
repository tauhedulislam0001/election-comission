<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_books', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('car_name');
            $table->dateTime('pickup_date_time');
            $table->string('airport_name');
            $table->string('division_name');
            $table->string('district_name');
            $table->string('thana_name');
            $table->integer('no_of_passenger')->nullable();
            $table->double('fair');
            $table->tinyInteger('status');
            $table->string('passenger_title')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->date('dob')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('mobile_number');
            $table->string('email');
            $table->string('airlines_name');
            $table->date('flight_date');
            $table->string('flight_time');
            $table->string('departure_time');
            $table->string('flight_number');
            $table->string('departure_country');
            $table->string('ticket_number')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('relative_mobile1')->nullable();
            $table->string('relative_mobile2')->nullable();
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
        Schema::dropIfExists('car_books');
    }
}
