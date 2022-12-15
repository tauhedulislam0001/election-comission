<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->nullable();
            $table->tinyInteger('user_type')->comment('1 = Super-Admin, 2 = Admin, 3 = User');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username', 50)->unique();
            $table->string('email', 150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('designation')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('dd')->nullable();
            $table->string('mm')->nullable();
            $table->string('yy')->nullable();
            $table->string('nationality')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = Inactive, 1 = Active');
            $table->tinyInteger('can_login')->default(0)->comment('0 = Can not login, 1 = Can login, 2 = Banned');
            $table->rememberToken();
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
        //
    }
}
