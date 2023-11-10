<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencies', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('invoice_id');
            $table->integer('member_id');
            $table->integer('franchise_id');
            $table->date('pickup_date');
            $table->integer('frequency');
            $table->string('pickup_time', 100);
            $table->string('delivery_time', 100);
            $table->integer('difference');
            $table->integer('day');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('frequencies');
    }
}
