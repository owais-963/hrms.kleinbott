<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_sms_logs', function (Blueprint $table) {
            $table->integer('PKSmsLogID')->primary();
            $table->integer('PKSMSID')->nullable()->index('PKSMSID');
            $table->string('InvoiceNumber', 225)->default('0');
            $table->string('Title', 2000)->nullable();
            $table->text('Content')->nullable();
            $table->text('Response')->nullable();
            $table->string('Phone', 100)->nullable();
            $table->string('IPAddress', 225)->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_sms_logs');
    }
}
