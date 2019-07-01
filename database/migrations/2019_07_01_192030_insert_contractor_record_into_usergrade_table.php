<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertContractorRecordIntoUsergradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $contractorGrade = DB::select('select * from UserGrades where Description = ?', ["CONTRACTOR"]);

        if ($contractorGrade == null) {
            DB::insert('insert into UserGrades (Description) values (?)', ["CONTRACTOR"]);
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
