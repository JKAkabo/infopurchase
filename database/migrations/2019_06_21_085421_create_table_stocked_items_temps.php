<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStockedItemsTemps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockedItemsTemp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ItemID')->nullable();
            $table->double('UnitCost')->nullable();
            $table->double('StockLevel')->nullable();
            $table->dateTime('ExpiryDate')->nullable();
            $table->string('BatchNo')->nullable();
            $table->string('StoreID')->nullable();
            $table->string('OrderID')->nullable();
            $table->string('Description')->nullable();
            $table->string('SupplierID')->nullable();
            $table->string('OrderUnit')->nullable();
            $table->double('ItemQuantity')->nullable();
            $table->double('QuantityOrdered')->nullable();
            $table->integer('OrderLineID')->nullable();
            $table->integer('OrderUnitID')->nullable();

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
        Schema::dropIfExists('table_stocked_items_temps');
    }
}
