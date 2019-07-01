@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="" method="">
                    <input type="input" list="suppliers" id="supplierId">
                    <datalist id="suppliers">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->SupplierID }}">{{ $supplier->ContactName }}</option>
                        @endforeach
                    </datalist>

                    <button type="button" class="btn btn-primary" id="getCreateFormBtn">Go</button>
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            <div id="createFormContainer" class="col-md-8">
            </div>

        </div>
    </div>

    <script>
        // jQuery("#supplierId").keyup(function (e) {
        //     if(jQuery("#supplierId").val() != "") {
        //        jQuery("#getCreateFormBtn").removeAttr("disabled");
        //     }
        //     else {
        //         jQuery("#getCreateFormBtn").attr("disabled");
        //     }
        // })
        jQuery("#getCreateFormBtn").click(function (e) {
            let supplierId = jQuery("#supplierId").val();
            jQuery("#createFormContainer").load({{ route('register-supplier-form') }} + supplierId);
        })
    </script>
@endsection
