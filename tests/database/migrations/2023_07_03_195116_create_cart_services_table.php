<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_services', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('cart_id');
            $table->integer('service_id');
            $table->integer('franchise_service_id');
            $table->string('title', 255);
            $table->string('category', 200);
            $table->integer('category_id');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('discount', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('package', 100)->default('No');
            $table->string('bundle', 100)->default('No');
            $table->string('preference', 100)->default('No');
            $table->text('desktop_image')->nullable();
            $table->text('mobile_image')->nullable();
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
        Schema::dropIfExists('cart_services');
    }
}
