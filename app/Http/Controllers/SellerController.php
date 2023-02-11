<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SellerController extends Controller
{
    public function Index(){
        return view('seller.seller_login');
    }

    public function Dashboard(){
        return view('seller.index');
    }

    public function Login(Request $request){
        $check =$request->all();
        if(Auth::guard('seller')->attempt(['email' => $check['email'],'password' => $check['password']])){
            return redirect()->route('seller.dashboard')->with('error','Login successfully');
        }else{
            return back()->with('error','Invalid email or pass');
        }
    }

    public function SellerLogout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_from')->with('error','Logout successfully');

    }

    public function SellerRegister(){
        return view('seller.seller_register');
    }

    public function SellerRegisterCreate(Request $request){
        Seller::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now()
        ]);
        return redirect()->route('seller_login_from')->with('error','created successfully');

    }
}
