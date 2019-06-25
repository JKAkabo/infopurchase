<?php

namespace App\Traits;

use App\StockItemView;
use App\StockMovement;
use Illuminate\Http\Request;

trait StockMovementApi
{

    public function getStockMovement(){
        return StockMovement::all();
    }

    public function getStockMovementView(){
        return StockItemView::all();
    }
    public function getOneStockMovementView($item_id, $store_id){
            $coming_stock = 233;
            $old_stock = StockItemView::where([['ItemCode', $item_id],['ServicePlaceCode', $store_id]])
                ->select('StockLevel')
                ->first();
            return $new_stock =$coming_stock + $old_stock->StockLevel;

    }

    public function getOneStockMovement($item_id){
        return StockMovement::where('ItemID', $item_id)->get();
    }

    public function saveStockMovement(Request $request){
        $stock_move =array(
            'ItemID'=> 'D000125',
            'ItemUnit'=> 'TABLET',
            'UnitCost'=> 0.01,
            'MoveQty'=> 414,
            'MoveType'=> 'Initial Stocks',
            'MoveDate'=> '2018-12-01 00=>00=>00',
            'MoveTime'=> '2018-12-01 00=>17=>05',
            'IssuerID'=> '00063',
            'ReceiverID'=> '0149',
            'IssuerStock'=> 0,
            'ReceiverStock'=> 414,
            'AdjustQty'=> 414,
            'UserID'=> ' 00063',
            'ServerDate'=> '2018-12-01 00=>00=>00',
            'ServerTime'=> '2018-12-01 00=>17=>05',
            'MoveNo'=> ' 1',
            'MoveOrder'=> 1,
            'BaseQty'=> 1,
            'IssuerUOMID'=> 1,
            'ReceiverUOMID'=> 1,
            'TransUnitType'=> 0,
            'ExpiredStock'=> 0
        );
    }
}