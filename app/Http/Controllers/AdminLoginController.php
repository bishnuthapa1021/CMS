<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    //
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $rules = [
                'email' =>'required|email',
                'password' =>'required'
            ];
            $customMessage = [
                'email.required' =>"Please Enter Email Address",
                'email.email' =>"Please Enter A Valid Email Address",
                'password.required' => "Please Enter Password",


            ];
                $this->validate($request,$rules, $customMessage);
                if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    return redirect()->route('adminDashboard');
                }else{
                    Session::flash('error-message','Invalid Email or Password');
                    return redirect()->route('adminLogin');
                }
        }
        if(Auth::guard('admin')->check()){
            return redirect()->route('adminDashboard');
        }else{
            return view('admin.auth.login');
        }

    }

    public function dashboard(){
        return view('admin.dashboard');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        Session::flash('info-message','Logout Successfully');
        return redirect()->route('adminLogin');
    }
}
