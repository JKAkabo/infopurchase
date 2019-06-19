<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockItemTemp extends Model
{
    protected $table = 'StockedItemsTemp';
    public $timestamps = false;

    /*public function StockedItems()
    {
        return $this->hasMany(StockItemTemp::class,'OrderID');
    }*/
}
