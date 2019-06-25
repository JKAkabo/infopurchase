<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLineItemBatch extends Model
{
    protected $table = 'OrderItemsBatches';

    protected $fillable =[
        "ItemID",
        "OrderID",
        "UnitCost",
        "BatchQty",
        "ExpiryDate",
        "BatchNo",
        "StoreID",
        "UnitID",
        "UserID",
        "ServerTime"
    ];

    public $timestamps = false;
}
