<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSupplierRecordIntoUsercategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $supplierCategory = DB::select('select * from UserCategories where Description = ? ', ["SUPPLIER"]);

        if ($supplierCategory == null) {
            DB::insert('insert into UserCategories (Description, UserID) values (?, ?)', ["SUPPLIER", "00005"]);
            return "Update successful";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
