<?php

namespace App\Http\Controllers;

use App\PurchaseOrderLinesApprovedPendingReceivalView;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderLinesApprovedPendingReceivalViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PurchaseOrderLinesApprovedPendingReceivalView::select('OrderID','ItemID','OrderUnit')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('orders-pending.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrderLinesApprovedPendingReceivalView  $purchaseOrderLinesApprovedPendingReceivalView
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrderLinesApprovedPendingReceivalView $purchaseOrderLinesApprovedPendingReceivalView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrderLinesApprovedPendingReceivalView  $purchaseOrderLinesApprovedPendingReceivalView
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrderLinesApprovedPendingReceivalView $purchaseOrderLinesApprovedPendingReceivalView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrderLinesApprovedPendingReceivalView  $purchaseOrderLinesApprovedPendingReceivalView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrderLinesApprovedPendingReceivalView $purchaseOrderLinesApprovedPendingReceivalView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrderLinesApprovedPendingReceivalView  $purchaseOrderLinesApprovedPendingReceivalView
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrderLinesApprovedPendingReceivalView $purchaseOrderLinesApprovedPendingReceivalView)
    {
        //
    }
}
