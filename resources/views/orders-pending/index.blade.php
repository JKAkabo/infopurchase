@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white ">
                        Infotech Supplier Inventory Interface (Orders Pending Receival)
                        <a href="{{route('home')}}" class="btn btn-warning btn-sm float-right text-white ">Back</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="example" class="table table-borderless table-striped table-hover data-table table-responsive-sm" >
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Purchase Order ID</th>
                                <th>ItemID</th>
                                <th>OrderUnit</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        /* Formatting function for row details - modify as you need */
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>Full name:</td>'+
                '<td>'+d.name+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Extension number:</td>'+
                '<td>'+d.extn+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Extra info:</td>'+
                '<td>And any further details here (images etc)...</td>'+
                '</tr>'+
                '</table>';
        }
        $(function () {

            /*
            'OrderType', 'OrderID','OrderLineID', 'ItemID', 'OrderUnit',
        'UnitCost', 'OrderQty','OrderQtyReceived', 'OrderLineStatus', 'StockLevel',
        'ReorderLevel', 'Base_No','Archived', 'ArchivedDate', 'ArchivedTime',
        'ArchiverID', 'CAP_ID','OrderUnitID', 'IssuedOrderQty', 'CashPrice',
        'CreditPrice', 'NGPrice','NHISPrice', 'Description',
        'ItemTypeCode','Expirable','ApprovedQty','OrderStoreID','SupplierID',
        'OrderDate','ProformaNo','InvoiceNo','AveUnitCost'
            * */

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders-pending') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'OrderID', name: 'OrderID'},
                    {data: 'ItemID', name: 'ItemID'},
                    {data: 'OrderUnit', name: 'OrderUnit'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // Add event listener for opening and closing details
            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );


        });
    </script>
@endsection
