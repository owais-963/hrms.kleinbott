<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('username', 30)->unique();
            $table->string('email', 100)->unique();
            $table->string('password')->nullable();
            $table->integer('password_attempt')->default(0);
            $table->string('country_code', 5)->nullable();
            $table->string('phone', 15)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('image')->default('user.png');
            $table->string('cover')->default('cover.png');
            $table->text('about')->nullable();
            $table->string('last_device_id')->nullable();
            $table->tinyInteger('last_device_type')->comment('1 for window, 2 for mac, 3 for android, 4 for ios')->default(1);
            $table->string('otp_code', 10)->nullable();
            $table->timestamp('otp_expire_at')->nullable();
            $table->integer('otp_attempt')->default(0);
            $table->tinyInteger('status')->comment('1 active 2 Block 0 pending')->default(0);
            $table->foreignId('role_id')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};