<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('session_id');
            $table->integer('device_id')->nullable();
            $table->string('hotel_name', 200)->nullable();
            $table->integer('hotel_id')->nullable();
            $table->string('room_no', 20)->nullable();
            $table->integer('member_id')->nullable();
            $table->string('postal_code', 50)->nullable();
            $table->integer('franchise_id')->nullable();
            $table->integer('has_address')->nullable();
            $table->string('address_type', 50)->default('');
            $table->string('addressTypes', 50)->default('');
            $table->string('collection_address_type', 50)->default('');
            $table->string('location', 200)->nullable();
            $table->tinyInteger('has_services', 100)->nullable()->comment('0 for later 1 for items');
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('city', 100);
            $table->string('pickup_date', 50);
            $table->string('pickup_time', 50);
            $table->string('delivery_date', 50);
            $table->string('delivery_time', 50);
            $table->integer('frequency')->default(0);
            $table->text('order_notes')->nullable();
            $table->integer('services_count')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
