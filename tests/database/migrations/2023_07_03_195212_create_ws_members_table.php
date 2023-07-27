<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_members', function (Blueprint $table) {
            $table->integer('PKMemberID')->index()->primary();
            $table->enum('RegisterFrom', ['mobile', 'desktop'])->default('Desktop');
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('FKFranchiseID')->default(0)->index('FKFranchiseID');
            $table->integer('OldMemberID')->nullable()->index('OldMemberID');
            $table->string('StripeCustomerID', 255)->nullable();
            $table->text('FacebookID')->nullable();
            $table->text('GoogleID')->nullable();
            $table->string('ReferralCode', 50)->nullable();
            $table->string('FirstName', 500)->nullable();
            $table->string('LastName', 500)->nullable();
            $table->integer('CountryCode')->default(44);
            $table->string('Phone', 100)->nullable();
            $table->string('EmailAddress', 225)->nullable()->index('EmailAddress');
            $table->string('Password', 500)->nullable()->index('Password');
            $table->string('BuildingName', 2000)->nullable();
            $table->string('StreetName', 2000)->nullable();
            $table->string('PostalCode', 225)->nullable();
            $table->string('Town', 225)->nullable();
            $table->text('AccountNotes')->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->default('Enabled')->index('Status');
            $table->enum('PopShow', ['yes', 'no'])->default('No')->index('PopShow');
            $table->integer('TotalLoyaltyPoints')->default(0);
            $table->integer('UsedLoyaltyPoints')->default(0);
            $table->unsignedInteger('InvoicePendingVersion')->default(0);
            $table->unsignedInteger('InvoiceProcessedVersion')->default(0);
            $table->unsignedInteger('InvoiceCancelVersion')->default(0);
            $table->unsignedInteger('InvoiceCompletedVersion')->default(0);
            $table->unsignedInteger('LoyaltyActiveVersion')->default(0);
            $table->unsignedInteger('LoyaltyHistoryVersion')->default(0);
            $table->unsignedInteger('DiscountActiveVersion')->default(0);
            $table->unsignedInteger('DiscountHistoryVersion')->default(0);
            $table->unsignedInteger('MemberCardVersion')->default(0);
            $table->unsignedInteger('MemberPreferenceVersion')->default(0);
            $table->unsignedInteger('MemberInformationVersion')->default(0);
            $table->boolean('NewsLetter')->default(0);
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('user_agent', 225)->nullable();
            $table->string('ip_address', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_members');
    }
}
