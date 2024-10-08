<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        @session_start();

    }
    
    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        if($request->username == ' ' || $request->password  == ' '){
            return redirect('/login')->with('notice', 'Tài khoản hoặc mật khẩu không được để trống');
        }
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
           return redirect('/admin/home');
        }else{
            return redirect('/login')->with('notice', 'Tài khoản hoặc mật khẩu không chinh xac');
        }

    }
    public function getLogout(){
        Auth::logout();
        return redirect('/login');
    }
}
