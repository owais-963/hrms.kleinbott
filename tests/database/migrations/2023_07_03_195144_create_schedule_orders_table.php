<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_orders', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('invoice_id');
            $table->integer('parent_invoice_id');
            $table->integer('frequency_id');
            $table->dateTime('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_orders');
    }
}
