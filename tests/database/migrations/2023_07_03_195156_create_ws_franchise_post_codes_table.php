<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsFranchisePostCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_franchise_post_codes', function (Blueprint $table) {
            $table->integer('PKPostCodeID')->primary();
            $table->integer('FKFranchiseID')->nullable()->index();
            $table->string('Code', 225)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_franchise_post_codes');
    }
}
