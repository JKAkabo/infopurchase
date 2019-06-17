<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = ['name', 'unit', 'supplier_id'];

    protected $primaryKey = 'id';
}
