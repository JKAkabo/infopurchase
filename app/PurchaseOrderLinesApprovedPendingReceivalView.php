<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLinesApprovedPendingReceivalView extends Model
{
    protected $table = 'PurchaseOrderLinesApprovedPendingReceivalView';
    public $timestamps = false;

    public function StockedItems()
    {
        return $this->hasMany(StockItemTemp::class,'OrderID');
    }
}
