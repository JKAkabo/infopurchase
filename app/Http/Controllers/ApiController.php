<?php

namespace App\Http\Controllers;

use App\PurchaseOrderLinesApprovedPendingReceivalView;
use App\QRCode;
use App\StockedItem;
use App\StockItemTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public $b_val = [
        'ItemID' => ['required', 'string', 'unique:users']
    ];
    public $qr_val = [
        'order_id' => ['required'],
        'qr_code_image' => ['required']
    ];

 /**
  * @OA\Get(
  *     path="/api/v1/pending-receival",
  *      summary="All Purchase Orders Pending Receival",
  *     @OA\Response(response="200",
  *     description="Get All Purchase Orders Pending Receival",
  *
  * ),
  *     tags={"Purchase Order"}
  * )
  *
  */
    public function getAllApprovalPendingReceival(){

       $pending_receival = PurchaseOrderLinesApprovedPendingReceivalView::all();

        if($pending_receival ==null){
            $msg =array(
                'code'=> '204',
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

    /**
     * @OA\Get(
     *     path="/api/v1/pending-receival/{orderId}",
     *     summary="Get Purchase Orders Pending Receival by Purchase Order No.",
     *     @OA\Response(response="200", description="Get All Purchase Orders Pending Receival"),
     *
     *     tags={"Purchase Order"},
     *     @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         description="Provider Purchase Order No a parameter",
     *
     *         @OA\Schema(type="string")
     *     )
     * )
     *
     */
    public function getOneApprovalPendingReceival($purchase_order_no){

        $pending_receival = PurchaseOrderLinesApprovedPendingReceivalView::all()
            ->where('OrderID',$purchase_order_no);

        if($pending_receival==null){
            $msg =array(
                'code'=> '204',
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

    /**
     * @OA\Post(
     *     path="/api/v1/pending-receival/{orderId}",
     *     summary="Generate a new Purchase Orders Pending Receival",
     *      tags={"Purchase Order"},
     *     @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         description="Provider Purchase Order No a parameter",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="ItemID",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="UnitCost",
     *                     type="string",
     *
     *                 ),
     *                 @OA\Property(
     *
     *                      property="StockLevel",
     *                     type="double",
     *                 ),
     *                   @OA\Property(
     *
     *                      property="ExpiryDate",
     *                     type="DateTime"
     *                 ),
     *                  @OA\Property(
     *                      property="BatchNo",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                      property="StoreID",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                      property="OrderID",
     *                     type="string",
     *                 ),
     *                 example={
     *                          "ItemID": "D22231",
     *                           "UnitCost": "1392813",
     *                          "StockLevel": "223",
     *                          "ExpiryDate": "2020-01-31 00:00:00.000",
     *                          "BatchNo":"237372",
     *                          "StoreID":"ST3372","OrderID":"234543"
     *                          }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function updateApprovalPendingReceival(Request $request, $purchase_order_no){

        $pending_receival = PurchaseOrderLinesApprovedPendingReceivalView::all()
            ->where('OrderID',$purchase_order_no);
        if($pending_receival==null){
            $msg =array(
                'code'=> '204',
                'message'=> 'No record found for this Purchase Order No',
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }

      /*  $validator = Validator::make($request->all(), $this->b_val);

        //validate
        if ($validator->fails()) {
            $msg =array(
                'code'=> '204',
                'message'=> 'Item ID must unique',
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        } else {*/

            $stocked_Item = new StockItemTemp();
            $stocked_Item->ItemID = $request->ItemID;
            $stocked_Item->UnitCost = $request->UnitCost;
            $stocked_Item->StockLevel = $request->StockLevel;
            $stocked_Item->ExpiryDate = $request->ExpiryDate;
            $stocked_Item->BatchNo = $request->BatchNo;
            $stocked_Item->StoreID = $request->StoreID;
            $stocked_Item->OrderID = $request->OrderID;
            $stocked_Item->Description = $request->Description;
            $save_stock = $stocked_Item->save();

        //}

        if(!$save_stock){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save Record for Purchase Order '.$request->OrderID,
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$save_stock
            );
        }
        return response()->json($msg, $msg['code']);

    }

    /**
     * @OA\Post(
     *     path="/api/v1/save-stored/{orderId}/{itemId}",
     *     summary="Receives a new Purchase Order(s)",
     *      tags={"Purchase Order"},
     *     @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         description="Supplier Purchase Order No a parameter",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="itemId",
     *         in="path",
     *         description=" Order Item No a parameter",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="ItemID",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="UnitCost",
     *                     type="string",
     *
     *                 ),
     *                 @OA\Property(
     *
     *                      property="StockLevel",
     *                     type="double",
     *                 ),
     *                   @OA\Property(
     *
     *                      property="ExpiryDate",
     *                     type="DateTime"
     *                 ),
     *                  @OA\Property(
     *                      property="BatchNo",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                      property="StoreID",
     *                     type="string",
     *                 ),
     *
     *                 example={
     *
     *                          "ItemID": "D22231",
     *                           "UnitCost": "1392813",
     *                          "StockLevel": "223",
     *                          "ExpiryDate": "2020-01-31 00:00:00.000",
     *                          "BatchNo":"237372",
     *                          "StoreID":"ST3372"
     *                          }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function saveAllCompletedPurchaseOrder($purchase_order_no, $item_id){
        $pending_receival = DB::table('StockedItemsTemp')
            ->where([
                ['OrderID',$purchase_order_no],
                ['ItemID',$item_id]
            ])->first();

        if($pending_receival==null){
            $msg =array(
                'code'=> '204',
                'message'=> 'No record found for this Purchase Order No',
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        }
        $stocked_Item = new StockedItem();
        $stocked_Item->ItemID = $pending_receival->ItemID;
        $stocked_Item->UnitCost = $pending_receival->UnitCost;
        $stocked_Item->StockLevel = $pending_receival->StockLevel;
        $stocked_Item->ExpiryDate = $pending_receival->ExpiryDate;
        $stocked_Item->BatchNo = $pending_receival->BatchNo;
        $stocked_Item->StoreID = $pending_receival->StoreID;

        $save_stock = $stocked_Item->save();
        //@TransactionBeginning::class;
        /*foreach ($pending_receival as $item) {
            $stocked_Item = new StockedItem();
            $stocked_Item->ItemID = $item->ItemID;
            $stocked_Item->UnitCost = $item->UnitCost;
            $stocked_Item->StockLevel = $item->StockLevel;
            $stocked_Item->ExpiryDate = $item->ExpiryDate;
            $stocked_Item->BatchNo = $item->BatchNo;
            $stocked_Item->StoreID = $item->StoreID;

            $save_stock = $stocked_Item->save();
        }*/

        if(!$save_stock){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save Stocked Item Record',
                'data'=>null
            );

        }else{
            DB::table('StockedItemsTemp')->where([
                ['OrderID',$purchase_order_no],
                ['ItemID',$item_id]
            ])->delete();
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$save_stock
            );
        }
        return response()->json($msg, $msg['code']);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/pending-check/{orderId}",
     *     summary="Get Purchase Orders Waiting to be checked and Approved.",
     *     @OA\Response(response="200", description="Get All Orders Waiting to be checked and Approved"),
     *
     *     tags={"Purchase Order"},
     *     @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         description="Provider Purchase Order No a parameter",
     *
     *         @OA\Schema(type="string")
     *     )
     * )
     *
     */
    public function getAllReceivalPending($purchase_order_no){

        $data =array();
        $pending_receival_check = StockItemTemp::all()
            ->where('OrderID',$purchase_order_no);

        $data['items'] = $pending_receival_check;


        if($pending_receival_check==null){
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

    /**
     * @OA\Post(
     *     path="/api/v1/save-qr-code",
     *     summary="save a new Purchase Order(s) QR Code",
     *      tags={"Purchase Order"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="order_id",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="qr_code_image",
     *                     type="string",
     *                  ),

     *                 example={
     *                          "order_id": 11,
     *                          "qr_code_image": "Base64 String"
     *                          }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function storeQR(Request $request){

        $validator = Validator::make($request->all(), $this->qr_val);

        //validate
        if ($validator->fails()) {
            $msg =array(
                'code'=> '204',
                'message'=> 'Sorry! Something went wrong',
                'data'=>null
            );
            return response()->json($msg, $msg['code']);
        } else {
            $save_qr = QRCode::on('sqlsrv_auth')->create($request->all());
        }
        if(!$save_qr){
            $msg =array(
                'code'=> '304',
                'message'=> 'Unable to Save QR-Code for Purchase Order '.$request->order_id,
                'data'=>null
            );

        }else{
            $msg =array(
                'code'=> '200',
                'message'=> 'success',
                'data'=>$save_qr
            );
        }
        return response()->json($msg, $msg['code']);
    }
}
