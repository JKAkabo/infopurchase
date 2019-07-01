<?php

namespace App\Http\Controllers;

use App\HamsSupplier;
use App\HamsUser;

use App\HamsUserType;
use App\Supplier;
use App\UserType;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HamsUserController extends Controller
{

    public $userValidationRules = [
        'fullName' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:50'],
//        'user_type' => ['required', 'integer'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->userValidationRules);

        //validate
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $supplierCategory = DB::select('select * from UserCategories where Description = ? ', ["SUPPLIER"]);
        $contractorGrade = DB::select('select * from UserGrades where Description = ?', ["CONTRACTOR"]);


        $save = DB::insert("insert into Users (UserID, UserName, UserNo, User_Password, UserIDNo, EmailAddress, CatID, PO_password, UserGrade, User_Date, User_Time, DataDate) values  (:fullName, :username, :id, HASHBYTES('MD5', :password), :idNo, :email, :categoryId, :purchaseOrderPassword, :userGradeId, :userDate, :userTime, :dataDate)",
            [
                'fullName' => $request->fullName,
                'username' => $request->username,
                'id' => $request->supplierId . '-s',
                'idNo' => "",
                'email' => $request->EmailAddress,
                'categoryId' => $supplierCategory[0]->CatID,
                'userGradeId' => $contractorGrade[0]->Code,
                'password' => $request->password,
                'purchaseOrderPassword' => Hash::make($request->password),

                'userDate' => date('Y-m-d 00:00:00.000'), // format defined to be consistent with db
                'userTime' => date('Y-m-d h:i:s.v'),
                'dataDate' => date('Y-m-d h:i:s.v'),
            ]);

        if (!$save) {
            return back()->withErrors($validator)->withInput();
        }


//        Auth::login($user);
        return redirect()->route('register-user-page');
    }

    public function create(Request $request)
    {
        $suppliers = HamsSupplier::all();

        $registeredSupplierIds = array();

        $registeredSuppliers = DB::table('Users')->select('UserNo')->where('UserNo', 'LIKE', '%-s%')->get();

        foreach ($registeredSuppliers as $registeredSupplier) {
            array_push($registeredSupplierIds, $registeredSupplier->UserNo);
        }

//        return $registeredSupplierIds;
        $unregisteredSuppliers = $suppliers->filter(function ($value, $key) use ($registeredSupplierIds) {
            if (!in_array($value->SupplierID . '-s', $registeredSupplierIds)) {
                return true;
            }
        });

//        return $suppliers->count() . "<br>" . $unregisteredSuppliers->count();
        return view('supplier.create', ['suppliers' => $unregisteredSuppliers]);
    }

    public function createForm($supplierId = null, Request $request)
    {
        if ($supplierId == null) {
            return "";
        }

        $supplier = DB::table('Suppliers')->where('SupplierID', $supplierId)->first();

        if ($supplier == null) {
            return "";
        }

        return view('supplier.create-form', ['supplier' => $supplier]);
    }

    public function get_user_type()
    {
        $types = new HamsUserType();
        $types = $types->all();
        return $types;
    }

//    public function insert_supplier_record_into_usercategory_table()
//    {
//        $supplierCategory = DB::select('select * from UserCategories where Description = ? ', ["SUPPLIER"]);
//
//        if ($supplierCategory == null) {
//            $query = DB::insert('insert into UserCategories (Description, UserID) values (?, ?)', ["SUPPLIER", "00005"]);
//            return "Update successful";
//        }
//        return "Update already performed";
//    }
//
//    public function insert_contractor_record_into_usergrade_table()
//    {
//        $contractorGrade = DB::select('select * from UserGrades where Description = ?', ["CONTRACTOR"]);
//
//        if ($contractorGrade == null) {
//            $query = DB::insert('insert into UserGrades (Description) values (?)', ["CONTRACTOR"]);
//            return "Update successful";
//        }
//        return "Update already performed";
//    }

    public function make_users_from_suppliers()
    {
        $suppliers = HamsSupplier::all();
        $supplierCategory = DB::select('select * from UserCategories where Description = ? ', ["SUPPLIER"]);
        $contractorGrade = DB::select('select * from UserGrades where Description = ?', ["CONTRACTOR"]);

        if ($supplierCategory == null || $contractorGrade == null)
            return "Perform protocol updates first";
//
//        $user = new HamsUser();
//        $user->UserNo = $suppliers[0]->SupplierID . '-s';
//        $user->UserName = "";
//        $user->UserID = "";
//        $user->EmailAddress = $suppliers[0]->EMail;
//        $user->PrimaryCellNo = "";
//        $user->CatID = $supplierCategory[0]->CatID;
//        $user->UserGrade = $contractorGrade[0]->Code;
        DB::insert("insert into Users (UserID, UserName, UserNo, User_Password, UserIDNo, EmailAddress, CatID, PO_password, UserGrade, User_Date, User_Time, DataDate) values  (:fullName, :username, :id, HASHBYTES('MD5', :password), :idNo, :email, :categoryId, :purchaseOrderPassword, :userGradeId, :userDate, :userTime, :dataDate)",
            [
                'fullName' => "",
                'username' => "",
                'id' => $suppliers[0]->SupplierID . '-s',
                'idNo' => "",
                'email' => $suppliers[0]->EmailAddress,
                'categoryId' => $supplierCategory[0]->CatID,
                'userGradeId' => $contractorGrade[0]->Code,
                'password' => 'neutron45',
                'purchaseOrderPassword' => Hash::make('neutron45'),
                'userDate' => date('Y-m-d 00:00:00.000'), // format defined to be consistent with db
                'userTime' => date('Y-m-d h:i:s.v'),
                'dataDate' => date('Y-m-d h:i:s.v'),
            ]);
//        $user->save();
        return "Successful";
    }

    public function check(Request $request)
    {
        return HamsUser::all();
    }
}
