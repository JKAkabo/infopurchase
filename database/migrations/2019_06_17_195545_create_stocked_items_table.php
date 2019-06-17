<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocked_items', function (Blueprint $table) {
            $table->string('ItemID')->nullable();
            $table->double('UnitCost')->nullable();
            $table->double('StockLevel')->nullable();
            $table->dateTime('ExpiryDate')->nullable();
            $table->string('BatchNo')->nullable();
            $table->string('StoreID')->nullable();
            $table->integer('NoPerBaseUnit')->nullable();
            $table->double('StockTransID')->nullable();
            $table->integer('StockedUnitID')->nullable();
            $table->integer('StockedTypeID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocked_items');
    }
}
