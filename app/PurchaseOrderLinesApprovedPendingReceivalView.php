<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLinesApprovedPendingReceivalView extends Model
{
    protected $table = 'PurchaseOrderLinesApprovedPendingReceivalView';

    protected $primaryKey = 'OrderID';
    protected $fillable = [
        'OrderType', 'OrderID','OrderLineID', 'ItemID', 'OrderUnit',
        'UnitCost', 'OrderQty','OrderQtyReceived', 'OrderLineStatus', 'StockLevel',
        'ReorderLevel', 'Base_No','Archived', 'ArchivedDate', 'ArchivedTime',
        'ArchiverID', 'CAP_ID','OrderUnitID', 'IssuedOrderQty', 'CashPrice',
        'CreditPrice', 'NGPrice','NHISPrice', 'Description',
        'ItemTypeCode','Expirable','ApprovedQty','OrderStoreID','SupplierID',
        'OrderDate','ProformaNo','InvoiceNo','AveUnitCost'
    ];

    public $timestamps = false;
    //protected $fillable = [];

    public function PendingReceivalView()
    {
        return $this->belongsTo(PurchaseOrderPendingReceival::class, 'OrderNo','OrderID');
    }

   /* public function order_lines()
    {
        return $this->hasMany(OrderLine::class,'OrderID', 'OrderID');
    }*/
}
