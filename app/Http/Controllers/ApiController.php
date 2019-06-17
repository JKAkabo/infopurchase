<?php

namespace App\Http\Controllers;

use App\PurchaseOrderLinesApprovedPendingReceivalView;
use App\StockedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function getAllApprovalPendingReceival(){

       $pending_receival = PurchaseOrderLinesApprovedPendingReceivalView::all();

        if($pending_receival ==null){
            $msg =array(
                'code'=> '200',
                'message'=> 'no record available',
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$pending_receival
            );
        }
        return response()->json($msg, $msg['code']);

    }

    public function getOneApprovalPendingReceival($purchase_order_no){

        $pending_receival = PurchaseOrderLinesApprovedPendingReceivalView::all()
            ->where('OrderID',$purchase_order_no);

        if($pending_receival==null){
            $msg =array(
                'code'=> '200',
                'message'=> 'no record available',
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$pending_receival
            );
        }
        return response()->json($msg, $msg['code']);

    }

    public function updateApprovalPendingReceival(Request $request, $purchase_order_no){

        $pending_receival = PurchaseOrderLinesApprovedPendingReceivalView::all()
            ->where('OrderID',$purchase_order_no);

        if($pending_receival.isEmpty()){
            $msg =array(
                'code'=> '404',
                'message'=> 'failed',
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$pending_receival
            );
        }
        return response()->json($msg, $msg['code']);

    }


    public function getAllApprovalPending(){

    }

    public function getStockedItem(){
        $stockedItems = StockedItem::all();

        return response()->json($stockedItems,200);
    }

    public function getOneStockedItem($item_id){
        $stockedItems = StockedItem::all()->where('ItemID', $item_id);
        return response()->json($stockedItems, 200);
    }

    public function updateStockedItem(Request $request, $item_id){
        $arr =array(
            'UnitCost'=> $request->UnitCost,
            'StockLevel'=> $request->StockLevel,
            'ExpiryDate'=> $request->ExpiryDate,
            'BatchNo'=> $request->BatchNo,
            'StoreID'=> $request->StoreID,
            'NoPerBaseUnit'=> $request->NoPerBaseUnit,
            'StockTransID'=> $request->StockTransID,
            'StockedUnitID'=> $request->StockedUnitID,
            'StockedTypeID'=> $request->StockedTypeID
        );

       $update = DB::table('stocked_items')->where('ItemID', $item_id)
           ->update($arr);
       if(!$update){
           $msg =array(
               'code'=> '404',
               'message'=> 'fail',
               'data'=>null
           );

       }else{
           $msg =array(
               'code'=> '200',
               'message'=> 'success',
               'data'=>StockedItem::all()->where('ItemID', $item_id)->first()
           );
       }
        return response()->json($msg, $msg['code']);
    }
}
