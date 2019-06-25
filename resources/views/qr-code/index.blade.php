@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white ">
                        Infotech Supplier Inventory Interface (Generated QR Codes)
                        <a href="{{route('home')}}" class="btn btn-warning btn-sm float-right text-white ">Back</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-borderless table-striped table-hover data-table table-responsive-sm" >
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Purchase Order ID</th>
                                <th>QR Code</th>
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
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('qr-codes') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'order_id', name: 'order_id'},
                    { data: 'qr_code_image', name: 'qr_code_image',
                        render: function( data, type, full, meta ) {
                            return '<img src="data:image/png;base64,'  + data + '" height="50"  >';
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection
