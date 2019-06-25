<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{

    protected $fillable = [
        'OrderID', 'OrderLineID','ItemID', 'OrderUnit', 'UnitCost',
        'OrderQty', 'OrderQtyReceived', 'OrderLineStatus', 'StockLevel',
        'ReorderLevel', 'Base_No', 'Archived', 'ArchivedDate', 'ArchivedTime',
        'ArchiverID', 'CAP_ID', 'OrderUnitID', 'IssuedOrderQty'
    ];

    protected $primaryKey = 'OrderID';
    protected $table = 'OrderLines';
    //protected $fillable = [];

    public function PendingReceivalView()
    {
        return $this->belongsTo(PurchaseOrderLinesApprovedPendingReceivalView::class, 'OrderID','OrderID');
    }
}
