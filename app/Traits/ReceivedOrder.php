<?php

namespace App\Traits;
use App\ReceivedOrder as RecOrder;
use App\StockedItem;
use App\StockItemTemp;
use App\StockItemView;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

trait ReceivedOrder
{

    /**
     * @OA\Get(
     *     path="/api/v1/received-orders",
     *     summary="All Received Purchase Orders",
     *      tags={"Received Purchase Orders"},
     *     @OA\Response(response="200",
     *     description="Get All Received Purchase Orders",
     *     ),
     *     )
     */
    public function getAllReceivedOrder(){

        $data = RecOrder::all();

        if($data ==null){
            $msg =array(
                'code'=> '204',
                'message'=> 'no record available',
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$data
            );
        }
        return response()->json($msg, $msg['code']);

    }

     /**
      * @OA\Get(
      *     path="/api/v1/received-orders/{orderId}",
      *     summary="All Received Purchase Orders by Order No",
      *      tags={"Received Purchase Orders"},
      *     @OA\Response(response="200",
      *     description="Get All Received Purchase Orders by Order No",
      *     ),
      *     @OA\Parameter(
      *         name="orderId",
      *         in="path",
      *         description="Provide Purchase Order No as a parameter",
      *         required=true,
      *         @OA\Schema(type="string")
      *         ),
      *     )
      *
      */
    public function getOneReceivedOrder($order_id){

        $data = RecOrder::all()->where('OrderNo', $order_id);

        if($data ==null){
            $msg =array(
                'code'=> '204',
                'message'=> 'no record available',
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$data
            );
        }
        return response()->json($msg, $msg['code']);

    }

    /**
     * @OA\Get(
     *     path="/api/v2/save-receive-orders/{PONo}/{itemId}",
     *     summary=" Saves Purchase Orders after Checks.",
     *     @OA\Response(response="200", description="Saves Purchase Orders after Checks"),
     *
     *     tags={"Received Purchase Orders"},
     *     @OA\Parameter(
     *         name="PONo",
     *         in="path",
     *         description="Provide a Purchase Order No as a parameter",
     *
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="itemId",
     *         in="path",
     *         description="Provide an item Id No as a parameter",
     *
     *         @OA\Schema(type="string")
     *     )
     * )
     *
     */
    public function saveReceivedOrder($order_id, $item_id){

        $primary_data = StockItemTemp::
        where('PONo',$order_id)
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
            ->sum('ItemQuantity');

    //Save Pending Items from Supplier
        $pending_receival = DB::table('StockedItemsTemp')->where([['PONo',$order_id], ['ItemID',$item_id]])->get();

      /*  return $pending_receival[0]->ItemID;
        exit();*/

        if($pending_receival->count() < 1){
            $msg =array(
                'code'=> '404',
                'message'=> 'No record found for this Purchase Order No: '.$order_id.' and Item ID: '. $item_id,
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }
        $stocked_Item = new StockedItem();
        $stocked_Item->ItemID = $pending_receival[0]->ItemID;
        $stocked_Item->UnitCost = $pending_receival[0]->UnitCost;
        $stocked_Item->StockLevel = $pending_receival[0]->StockLevel;
        $stocked_Item->ExpiryDate = $pending_receival[0]->ExpiryDate;
        $stocked_Item->BatchNo = $pending_receival[0]->BatchNo;
        $stocked_Item->StoreID = $pending_receival[0]->StoreID;

        $save_stock = $stocked_Item->save();

        if(!$save_stock){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save Stocked Item Record',
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }


        $data = array(
            "OrderNo"=> $order_id,
            "ReceiverID"=> '00001',
            "ReceivedDate"=> Carbon::now()->format('Y-m-d'),
            "ReceivedTime"=> Carbon::now(),
            "OrderStatus"=> 3,
            "InvoiceNo"=> " ",
            "ReceivedStoreID"=> $_data->StoreID,
            "LinesTotal"=> $primary_data_count,
            "TotalValue"=> $primary_data_sum,
            "SupplierID"=> $_data->SupplierID ,
            "UserID"=> "00001",
            "ServerTime"=> Carbon::now(),
            "OrderID"=> $p_no->OrderID
        );

        //Save Received Order

        $save_received_order = new \App\ReceivedOrder();
        $save_received_order->fill( $data );
        $save_received_order->save();

        if(!$save_received_order){
                $msg =array(
                    'code'=> '304',
                    'message'=> 'Unable to Save Record for Purchase Order '. $order_id,
                    'data'=>null
                );
            return response()->json($msg, $msg['code']);
        }
        //Save Received  Order Lines
        $data_received_line = array(
            "ItemID"=> $primary_data->ItemID,
            "UnitCost"=> $primary_data->UnitCost,
            "ReceivedID"=> $save_received_order->id,
            "ReceivedQty"=> $primary_data->ItemQuantity,
            "ReceivedUnit"=> $primary_data->OrderUnit,
            "ReceiverID"=> '00001',
            "StoreID"=> $primary_data->StoreID,
            "OrderLineID"=> $primary_data->OrderLineID,
            "OrderNo"=> $order_id,
            "OrderStatus"=> 3,
            "Base_No"=> "1",
            "ReceivedUnitID"=> $primary_data->OrderUnitID,
            //"SupplierID"=> $primary_data->SupplierID ,
            "UserID"=> '00001',
            "ServerTime"=> Carbon::now(),
            "ReceivedDate"=> Carbon::now()->format('Y-m-d'),
            "ReceivedTime"=> Carbon::now(),
        );


        $save_received_line_order = new \App\OrderLineReceived();
        $save_received_line_order->fill( $data_received_line );
        $save_received_line_order->save();

            if(!$save_received_line_order){
                $msg =array(
                    'code'=> '304',
                    'message'=> 'Unable to Save Record for Purchase Order '. $order_id,
                    'data'=>null
                );
                return response()->json($msg, $msg['code']);
            }

        //Save Order Line
        $data_order_line = array(
            "OrderID"=> $order_id,
            "ItemID"=> $primary_data->ItemID,
            "Base_No"=> '1',
            "OrderUnit"=> $primary_data->OrderUnit,
            "OrderUnitID"=> $primary_data->OrderUnitID,
            "UnitCost"=> $primary_data->UnitCost,
            "OrderQty"=> $primary_data->QuantityOrdered,
            "OrderQtyReceived"=> $primary_data->ItemQuantity,
            "OrderLineStatus"=> 3
        );

            $save_order_line = DB::table('OrderLines')->where('OrderID',$order_id)
                ->update($data_order_line);

            if(!$save_order_line){
                $msg =array(
                    'code'=> '304',
                    'message'=> 'Unable to Update Record for Purchase Order '. $order_id,
                    'data'=>null
                );
                return response()->json($msg, $msg['code']);

        }

        //Save Batches
        $received_order_batch = array(
            "ItemID"=> $_data->ItemID,
            "OrderID"=> $order_id,
            "UnitCost"=> $_data->UnitCost,
            "BatchQty"=> $_data->ItemQuantity,
            "ExpiryDate"=> $_data->ExpiryDate,
            "BatchNo"=> $_data->BatchNo,
            "StoreID"=> $_data->StoreID,
            "UnitID"=> $_data->OrderUnitID,
            "UserID"=> "00001",
            "ServerTime"=> Carbon::now(),
        );

        $save_received_order_batch = new \App\OrderLineItemBatch();
        $save_received_order_batch->fill( $received_order_batch );
        $save_received_order_batch->save();

        if(!$save_received_order_batch){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save Record for Purchase Order '. $order_id,
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }
        /*return $save_received_order_batch;
        exit();*/
        //Save Orders
        //Get old Totals
        $old = \App\Order::where('OrderNo',$order_id)->first();
        $data_orders = array(
            "OrderStatus"=> 3,
            "LinesTotal"=>$old->LinesTotal + $primary_data_count,
            "TotalValue"=>$old->TotalValue + $primary_data_sum,
        );

        $save_order = DB::table('Orders')
            ->where('OrderNo',$order_id)
            ->update($data_orders);
        if(!$save_order){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Update Record for Purchase Order '. $order_id,
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }

    //Save Stock movement
        //Calculate new stock levels
        $coming_stock = $primary_data->ItemQuantity;
        $old_stock = StockItemView::where([['ItemCode', $item_id],['ServicePlaceCode', $primary_data->StoreID]])
            ->select('StockLevel')
            ->first();
        $new_stock =$coming_stock + $old_stock->StockLevel;
        $stock_move =array(
            'ItemID'=> $primary_data->ItemID,
            'ItemUnit'=> $primary_data->OrderUnit,
            'UnitCost'=> $primary_data->UnitCost,
            'MoveQty'=> $primary_data->ItemQuantity,
            'MoveType'=> 'Orders',
            'MoveDate'=> Carbon::now()->format('Y-m-d'),
            'MoveTime'=> Carbon::now(),
            'IssuerID'=>  $primary_data->SupplierID,
            'ReceiverID'=> $primary_data->StoreID,
            'IssuerStock'=> 0,
            'ReceiverStock'=> $new_stock,
            'AdjustQty'=> $primary_data->ItemQuantity,
            'UserID'=> ' 00063',
            'ServerDate'=> Carbon::now()->format('Y-m-d'),
            'ServerTime'=> Carbon::now(),
            'MoveNo'=> ' 1',
            'BaseQty'=> 1,
            'IssuerUOMID'=> 1,
            'ReceiverUOMID'=> 1,
            'TransUnitType'=> 0,
            'ExpiredStock'=> 0
        );

        $save_stock_move = new \App\StockMovement();
        $save_stock_move->fill( $stock_move );
        $save_stock_move->save();

        if(!$save_stock_move){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save Record for STOCK MOVEMENT with ids '. $order_id. '/'. $primary_data->StoreID,
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }

        //Delete stock after validation
        $delete_stock_temp = DB::table('StockedItemsTemp')->where([
            ['OrderID',$order_id],
            ['ItemID',$item_id]
        ])->delete();

        if(!$delete_stock_temp){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save Stocked Item Record',
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }

        $msg =array(
            'code'=> '200',
            'message'=> 'success',
        );


        return response()->json($msg, $msg['code']);
    }
}