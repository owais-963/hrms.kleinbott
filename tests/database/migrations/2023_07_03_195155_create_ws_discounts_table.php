<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_discounts', function (Blueprint $table) {
            $table->integer('PKDiscountID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('FKMemberID')->default(0)->index('FKMemberID');
            $table->integer('OldDiscountID')->nullable()->index('OldDiscountID');
            $table->enum('DiscountFor', ['discount', 'referral', 'loyalty', 'membership'])->default('Discount')->index('DiscountFor');
            $table->string('Code', 50)->nullable()->index('Code');
            $table->string('Worth', 50)->nullable();
            $table->enum('DType', ['percentage', 'price'])->nullable();
            $table->date('StartDate')->nullable();
            $table->date('ExpireDate')->nullable();
            $table->enum('CodeUsed', ['one time', 'multiple time'])->default('One Time')->index('CodeUsed');
            $table->decimal('MinimumOrderAmount', 10, 2)->nullable();
            $table->enum('Status', ['expire', 'used', 'active'])->nullable()->index('Status');
            $table->enum('IsMembership', ['yes', 'no'])->default('No');
            $table->integer('FKMembershipID')->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_discounts');
    }
}
