<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderPendingReceival extends Model
{
    protected $table = 'PurchaseOrdersApprovedPendingReceivalView';

    protected $fillable = [
        'OrderType','OrderStore','OrderStoreID','SupplierID','OrderDate','InvoiceNo',
        'Supplier','AwardNo','PONo','Discount','LinesTotal','OrderComments',
        'VAT','ProformaNo','OrderNo','TotalValue'
    ];

    public function order_lines()
    {
        return $this->hasMany(PurchaseOrderLinesApprovedPendingReceivalView::class,'OrderID', 'OrderNo');
    }
    public $timestamps = false;
}
