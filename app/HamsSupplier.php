<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class HamsSupplier extends Model
{
    protected $fillable = ['SupplierID', 'ContactName', 'TelephoneNo', 'EMail', 'PostalAddrs',
        'FaxNo', 'UserID', 'SuppDate', 'Category', 'CreditLimit', 'AutoFillPO', 'ItemsTypeSupplied',
        'TIN', 'VatRate', 'OutAmt', 'CAP_ID', 'Disable', 'Archived', 'ArchivedDate',
        'ArchivedTime', 'ArchiverID', 'AccountNo'];

    public $timestamps = false;

    protected $table = 'Suppliers';
}