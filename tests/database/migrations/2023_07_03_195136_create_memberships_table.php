<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('member_id');
            $table->morphs('membership');
            $table->float('price');
            $table->float('discount_worth')->nullable();
            $table->integer('discount_id')->nullable();
            $table->string('code', 255)->nullable();
            $table->string('status', 50)->default('active');
            $table->text('payment_method');
            $table->text('payment_intent');
            $table->text('payment_intent_secret');
            $table->integer('cancel_at')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}
