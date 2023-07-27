<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_invoices', function (Blueprint $table) {
            $table->integer('PKInvoiceID')->primary();
            $table->integer('FKDeviceID')->nullable()->index('FKDeviceID');
            $table->integer('OldInvoiceID')->default(0)->index('OldInvoiceID');
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('FKFranchiseID')->default(0)->index('FKFranchiseID');
            $table->integer('FKMemberID')->nullable()->index('ws_invoices_PKMemberID');
            $table->integer('FKCardID')->nullable()->index('FKCardID');
            $table->integer('FKCartID')->nullable();
            $table->integer('FKDiscountID')->nullable();
            $table->string('AppVersion', 30)->nullable();
            $table->integer('ReferralID')->nullable()->index('ReferralID');
            $table->enum('DiscountType', ['none', 'discount', 'referral'])->default('None')->index('DiscountType');
            $table->string('DiscountCode', 50)->nullable()->index('DiscountCode');
            $table->string('DiscountWorth', 50)->nullable()->index('DiscountWorth');
            $table->enum('DType', ['none', 'percentage', 'price'])->default('None')->index('DType');
            $table->enum('InvoiceType', ['items', 'after'])->default('Items')->index('InvoiceType');
            $table->string('Currency', 50)->default('&pound;');
            $table->string('InvoiceNumber', 50)->nullable();
            $table->string('Location', 2000)->nullable();
            $table->string('Locker', 2000)->nullable();
            $table->integer('HasAddress')->nullable();
            $table->string('AddressType', 50)->default('');
            $table->string('CollectionAddressType', 50)->default('');
            $table->integer('HotelID')->nullable();
            $table->string('RoomNo', 10)->nullable();
            $table->string('HotelName', 225)->nullable();
            $table->string('BuildingName', 2000)->nullable();
            $table->string('StreetName', 2000)->nullable();
            $table->string('PostalCode', 225)->nullable();
            $table->string('Town', 225)->nullable();
            $table->text('CustomerNotes')->nullable();
            $table->text('OrderNotes')->nullable();
            $table->text('AccountNotes')->nullable();
            $table->text('AdditionalInstructions')->nullable();
            $table->enum('PaymentMethod', ['stripe', 'world pay', 'cash', 'ccnow', 'paypal', 'googlepay', 'applepay'])->default('Cash');
            $table->enum('PaymentStatus', ['pending', 'processed', 'cancel', 'completed', 'failed', 'bundled'])->default('Pending');
            $table->enum('OwnerPaymentStatus', ['no', 'yes'])->default('No');
            $table->text('PaymentReference')->nullable();
            $table->text('PaymentToken')->nullable();
            $table->enum('OrderStatus', ['pending', 'processed', 'cancel', 'completed'])->default('Pending');
            $table->decimal('ServicesTotal', 10, 2)->nullable();
            $table->decimal('PreferenceTotal', 10, 2)->nullable();
            $table->decimal('SubTotal', 10, 2)->nullable();
            $table->decimal('DiscountTotal', 10, 2)->nullable();
            $table->decimal('ServiceCharges', 10, 2)->default(0.00);
            $table->decimal('GrandTotal', 10, 2)->nullable();
            $table->string('IPAddress', 100)->nullable();
            $table->enum('OrderPostFrom', ['desktop', 'mobile'])->default('Desktop');
            $table->date('PickupDate')->nullable();
            $table->string('PickupTime', 100)->nullable();
            $table->date('DeliveryDate')->nullable();
            $table->string('DeliveryTime', 100)->nullable();
            $table->boolean('Regularly')->default(0);
            $table->enum('IsTestOrder', ['yes', 'no'])->default('No')->index('IsTestOrder');
            $table->enum('PickupNotification', ['yes', 'no'])->default('No');
            $table->enum('DeliveryNotification', ['yes', 'no'])->default('No');
            $table->enum('PickupDriverConfirmed', ['yes', 'no'])->default('No')->index('DriverConfirmed');
            $table->enum('DeliveryDriverConfirmed', ['yes', 'no'])->default('No')->index('DeliveryDriverConfirmed');
            $table->text('TookanResponse')->nullable();
            $table->text('TookanUpdateResponse')->nullable();
            $table->text('OnfleetResponse')->nullable();
            $table->text('OnfleetUpdateResponse')->nullable();
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
        Schema::dropIfExists('ws_invoices');
    }
}
