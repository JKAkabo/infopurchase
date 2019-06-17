<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderLinesApprovedPendingReceivalViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_lines_approved_pending_receival_views', function (Blueprint $table) {
            $table->integer('OrderType')->nullable()->nullable();
            $table->bigInteger('OrderID')->nullable();
            $table->bigInteger('OrderLineID')->nullable();
            $table->string('ItemID')->nullable();
            $table->string('OrderUnit')->nullable();
            $table->double('UnitCost')->nullable();
            $table->double('OrderQty')->nullable();
            $table->double('OrderQtyReceived')->nullable();
            $table->boolean('OrderLineStatus')->nullable();
            $table->double('StockLevel')->nullable();
            $table->double('ReorderLevel')->nullable();
            $table->bigInteger('Base_No')->nullable();
            $table->string('Archived')->nullable();
            $table->dateTime('ArchivedDate')->nullable();
            $table->dateTime('ArchivedTime')->nullable();
            $table->string('ArchiverID')->nullable();
            $table->string('CAP_ID')->nullable();
            $table->bigInteger('OrderUnitID')->nullable();
            $table->double('IssuedOrderQty')->nullable();
            $table->double('CashPrice')->nullable();
            $table->double('CreditPrice')->nullable();
            $table->double('NGPrice')->nullable();
            $table->double('NHISPrice')->nullable();
            $table->string('Description')->nullable();
            $table->integer('ItemTypeCode')->nullable();
            $table->string('Expirable')->nullable();
            $table->integer('ItemClassCode')->nullable();
            $table->double('ApprovedQty')->nullable();
            $table->string('OrderStoreID')->nullable();
            $table->string('SupplierID')->nullable();
            $table->dateTime('OrderDate')->nullable();
            $table->string('ProformaNo')->nullable();
            $table->string('InvoiceNo')->nullable();
            $table->double('AveUnitCost')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_lines_approved_pending_receival_views');
    }
}
