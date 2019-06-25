<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedOrder extends Model
{
    protected $table = 'ReceivedOrders';
    protected $fillable = [
        "OrderNo",
        "ReceiverID",
        "ReceivedDate",
        "ReceivedTime",
        "OrderStatus",
        "InvoiceNo",
        "ReceivedStoreID",
        "LinesTotal",
        "TotalValue",
        "SupplierID",
        "UserID",
        "ServerTime",
        "OrderID"
    ];

    public $timestamps = false;
}
