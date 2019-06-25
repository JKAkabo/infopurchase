<?php

namespace App\Http\Controllers;

use App\QRCode;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = QRCode::on('sqlsrv_auth')
                ->select('order_id','qr_code_image')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('qr-code.index');
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
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function show(QRCode $qRCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function edit(QRCode $qRCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QRCode $qRCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(QRCode $qRCode)
    {
        //
    }
}
