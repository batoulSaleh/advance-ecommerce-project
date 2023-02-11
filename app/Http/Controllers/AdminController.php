<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function Index(){
        return view('admin.admin_login');
    }

    public function Dashboard(){
        return view('admin.index');
    }

    public function Login(Request $request){
        $check =$request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'],'password' => $check['password']])){
            return redirect()->route('admin.dashboard')->with('error','Login successfully');
        }else{
            return back()->with('error','Invalid email or pass');
        }
    }

    public function destroy(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_from')->with('error','Logout successfully');

    }

    public function AdminRegister(){
        return view('admin.admin_register');
    }

    public function AdminRegisterCreate(Request $request){
        Admin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now()
        ]);
        return redirect()->route('login_from')->with('error','created successfully');

    }
}
