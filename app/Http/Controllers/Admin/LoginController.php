<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    // public function __construct(){
    //     $this->middleware('is.login.admin')->except(['logout']);
    // }
    public function index(){
        // tra ve 1 giao dien 
        return view('admin.login.index');
    }
    public function handleLogin(LoginPostRequest $request){
       $username=$request->input('username');
       $password =$request->input('password');
       $infoUser=Account::
                        where([
                            'username'=>$username,
                            'role_id'=>1
                            ])->first();
     
        if(!empty($infoUser)&& Hash::check($password,$infoUser->password)){
            $request->session()->put('id',$infoUser->id);
            $request->session()->put('username',$infoUser->username);
            $request->session()->put('email',$infoUser->email);
            $request->session()->put('role_id',$infoUser->rides_id);
            // cho vao trang dashboard
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('error_login','tai khoan khong ton tai')->withInput();
        }
    }
    public function logout(Request $request){
        $request->session()->forget('username');
        $request->session()->forget('id');
        $request->session()->forget('role_id');
        $request->session()->forget('email');
        return redirect()->route('admin.login');
    }
}
