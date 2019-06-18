<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDTO extends Model
{
    protected $table = ['stocked_items','purchase_order_lines_approved_pending_receival_views'];


    protected $fillable = [
        'Description',
        'OrderUnit',
        'OrderQtyReceived',
        'UnitCost',
        'SupplierID',
        'OrderID',
        'StockedTypeID',
        'ExpiryDate',
        'ItemID',
        'StockLevel',
        'BatchNo',
        'StoreID',

    ];

}
