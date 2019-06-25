@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        Infotech Supplier Inventory Interface
                    </p>

                        <p>
                        <div class="row" >
                            <div class="col-sm-4" >
                                <a class="btn btn-success text-white" style="width: 200px;" >Add New Supplier</a>
                                <p></p>
                                <a class="btn btn-success text-white" style="width: 200px;" >Add New Item</a>
                            </div>
                            <div class="col-sm-4" >
                                <a class="btn btn-success text-white" href="{{route('orders-pending')}}" style="width: 200px;" >Pending Purchase Orders</a>
                            </div>

                            <div class="col-sm-4" >
                                <a class="btn btn-success text-white" style="width: 200px;" href="{{route('qr-codes')}}" >QR Codes</a>
                            </div>

                        </div>
                        </p>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
