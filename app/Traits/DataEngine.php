<?php

namespace App\Traits;

use App\StockItemTemp;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait DataEngine
{
    public function getData($order_id,$item_id, $model){
        $primary_data = StockItemTemp::
        where([['OrderID',$order_id], ['ItemID',$item_id]])
            ->first();
        $p_no =  $_data = \App\Order::
        where('OrderNo',$order_id)
            ->first();

        $_data = StockItemTemp::
        where('OrderID',$order_id)
            ->first();
        $primary_data_count = StockItemTemp::
        where('OrderID',$order_id)
            ->count();
        $primary_data_sum = StockItemTemp::
        where('OrderID',$order_id)
            ->sum('UnitCost');

        $data = array();
        switch ($model) {
            case "ReceivedOrder":
               return $data = array(
                    "OrderNo"=> $order_id,
                    "ReceivedDate"=> Carbon::now()->format('Y-m-d'),
                    "ReceivedTime"=> Carbon::now(),
                    "OrderStatus"=> 3,
                    "ReceivedStoreID"=> $_data->StoreID,
                    "LinesTotal"=> $primary_data_count,
                    "TotalValue"=> $primary_data_sum,
                    "SupplierID"=> $_data->SupplierID ,
                    "UserID"=> "00001",
                    "ServerTime"=> Carbon::now(),
                    "OrderID"=> $p_no->OrderID
                );
                break;
            case "OrderReceivedLine":
                return $data = array(
                    "ItemID"=> $_data->ItemID,
                    "UnitCost"=> $_data->UnitCost,
                    "ReceivedID"=> $_data->OrderUnit,
                    "ReceivedQty"=> $_data->ItemQuantity,
                    "ReceivedUnit"=> $_data->OrderUnit,
                    "ReceiverID"=> "00001",
                    //"ExpiryDate"=> $_data->ItemQuantity,
                    //"BatchNo"=> 3,
                    "StoreID"=> $_data->StoreID,
                    "OrderLineID"=> '',
                    "OrderNo"=> $order_id,
                    "OrderStatus"=> 3,
                    "OrderLineStatus"=> 3,
                    "ReceivedUnitID"=> StockedUnitID,
                    "SupplierID"=> $_data->SupplierID ,
                    "UserID"=> "00001",
                    "ServerTime"=> Carbon::now(),
                    "ReceivedDate"=> Carbon::now()->format('Y-m-d'),
                    "ReceivedTime"=> Carbon::now(),
                );
                break;
            case "OrderLine":
                return $data = array(
                    "OrderID"=> $order_id,
                    "ItemID"=> $_data->ItemID,
                    "OrderUnit"=> $_data->OrderUnit,
                    "OrderUnitID"=> $_data->StockedUnitID,
                    "UnitCost"=> $_data->UnitCost,
                    "OrderQty"=> $_data->QuantityOrdered,
                    "OrderQtyReceived"=> $_data->ItemQuantity,
                    "OrderLineStatus"=> 3,
                    "ReceiverID"=> "00001",
                );
                break;
            case "OrderBatch":
                return $data = array(
                    "ItemID"=> $_data->ItemID,
                    "OrderID"=> $order_id,
                    "UnitCost"=> $_data->UnitCost,
                    "BatchQty"=> $_data->ItemID,
                    "ExpiryDate"=> $_data->ExpiryDate,
                    "BatchNo"=> $_data->BatchNo,
                    "StoreID"=> $_data->StoreID,
                    "UnitID"=> $_data->StockedUnitID,
                    "UserID"=> "00001",
                    "ServerTime"=> Carbon::now(),
                );
                break;
            case "Order":
                return $data = array(
                    "OrderStatus"=> 3,
                    "LinesTotal"=> $_data->UnitCost,
                    "TotalValue"=> $_data->ItemID,
                );
                break;
            default:
                return "No Selected";
        }
    }
}