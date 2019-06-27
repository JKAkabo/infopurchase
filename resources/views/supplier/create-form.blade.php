<form action="{{ route('add-supplier') }}" method="post">
    @csrf
    <input type="hidden" value="{{ $supplier->SupplierID }}" name="supplierId">
    <div class="form-group">
        <label for="supplierEmail">Email address:</label>
        <input type="email" id="supplierEmail" name="email" value="{{ $supplier->EMail }}" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="supplierFullName">Full Name</label>
        <input type="text" id="supplierFullName" name="fullName" value="{{ $supplier->ContactName }}" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="supplierUsername">Username</label>
        <input type="text" id="supplierUsername" name="username" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="supplierPassword">Password</label>
        <input type="password" id="supplierPassword" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="supplierConfirmPassword">Confirm Password</label>
        <input type="password" id="supplierConfirmPassword" name="password_confirmation" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>