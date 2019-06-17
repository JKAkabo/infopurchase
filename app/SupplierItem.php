<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierItem extends Model
{
    protected $table = 'supplier_items';

    protected $fillable = ['supplier_id', 'item_id', 'quantity_ordered', 'quantity_received'];

    protected $primaryKey = 'id';
}
