<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLineReceived extends Model
{
    protected $table = 'OrderLinesReceived';

    protected $fillable = [
        "ItemID",
        "UnitCost",
        "ReceivedID",
        "ReceivedQty",
        "ReceivedUnit",
        "ReceiverID",
        "StoreID",
        "OrderLineID",
        "OrderNo",
        "OrderStatus",
        "ReceivedUnitID",
        "UserID",
        "ServerTime",
        "ReceivedDate",
        "ReceivedTime",
        "Base_No"
    ];

    public $timestamps = false;
}
