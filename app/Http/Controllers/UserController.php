<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public $b_val = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'user_type' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
        $validator = Validator::make($request->all(), $this->b_val);

        //validate
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->user_type = $request->user_type;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $save = $user->save();
        }

        if (!$save){
            return back()->withErrors($validator)->withInput();
        }

         Auth::login($user);
        return redirect()->route('home');
    }
}
