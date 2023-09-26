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
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('note')->nullable();
            $table->tinyInteger('status')->comment('1 approve, 0 late')->default(0);
            $table->time('shift_start_time')->nullable();
            $table->time('shift_end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['note', 'status', 'shift_start_time', 'shift_end_time']);
        });
    }
};
