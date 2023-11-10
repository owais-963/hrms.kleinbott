<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // Assuming 'id' is the primary key and auto-incrementing

            // Personal Information
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('username', 30)->unique();
            $table->string('email', 100)->unique();
            $table->string('password')->nullable();

            $table->integer('password_attempt')->default(0); // Number of password attempts

            // Contact Information
            $table->string('country_code', 5)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->integer('city')->nullable();
            $table->integer('state')->nullable();
            $table->integer('country')->nullable();
            $table->string('zip_code')->nullable();

            // Profile Information
            $table->string('image')->default('user.png');
            $table->text('about')->nullable();
            $table->integer('designation_id')->nullable();
            $table->string('cnic')->nullable();
            $table->integer('employee_id')->nullable();
            // Appointment Information
            $table->date('appointment_Date')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('branch_id')->nullable();

            // Email Verification
            $table->timestamp('email_verified_at')->nullable();

            // Last Login Information
            $table->string('last_device_id')->nullable();
            $table->tinyInteger('last_device_type')->comment('1 for window, 2 for mac, 3 for android, 4 for ios')->default(1);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();

            // OTP (One-Time Password) Information
            $table->string('otp_code', 10)->nullable();
            $table->timestamp('otp_expire_at')->nullable();
            $table->integer('otp_attempt')->default(0); // Number of OTP attempts

            // User Status
            $table->tinyInteger('status')->comment('1 active, 2 Block, 0 pending')->default(0);

            // Foreign Key to Roles Table
            $table->foreignId('role_id')->nullable();
            $table->foreignId('shift_id')->nullable();

            $table->softDeletes(); // Soft Delete (if required)
            $table->rememberToken(); // Remember Token for authentication
            $table->timestamps(); // Created At and Updated At timestamps

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
