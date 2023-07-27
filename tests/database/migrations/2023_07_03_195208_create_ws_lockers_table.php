<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_lockers', function (Blueprint $table) {
            $table->integer('PKLockerID')->primary();
            $table->integer('FKLocationID')->nullable()->index('FKLocationID');
            $table->string('Title', 2000)->nullable();
            $table->integer('Position')->nullable();
            
            $table->index(['Title`(767'], 'Title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_lockers');
    }
}
