<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemInventory extends Model
{
    protected $table = 'item_inventories';

    protected $fillable = ['item_id', 'quantity', 'low_alert_quantity', 'allow_reorder', 'reorder_quantity'];

    protected $primaryKey = 'id';
}
