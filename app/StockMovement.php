<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $table = 'STOCKMOVEMENT';

    protected $fillable = [
        'ItemID',
        'ItemUnit',
        'UnitCost',
        'MoveQty',
        'MoveType',
        'MoveDate',
        'MoveTime',
        'IssuerID',
        'ReceiverID',
        'IssuerStock',
        'ReceiverStock',
        'AdjustQty',
        'UserID',
        'ServerDate',
        'ServerTime',
        'MoveNo',
        'MoveOrder',
        'BaseQty',
        'IssuerUOMID',
        'ReceiverUOMID',
        'TransUnitType',
        'ExpiredStock'
    ];
    public $timestamps = false;
}
