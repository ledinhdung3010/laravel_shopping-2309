<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Http\Request;
use App\Models\Account;

class LoginController extends Controller
{
    public function index(){
        return view ('frontend.login.index');
    }
    public function handle(LoginPostRequest $request){
        $username=$request->input('username');
       $password =$request->input('password');
       $infoUser=Account::
                        where([
                            'username'=>$username,
                            'password'=>$password
                            ])->first();
     
        if(!empty($infoUser)){
            $request->session()->put('id',$infoUser->id);
            $request->session()->put('user',$infoUser->username);
            $request->session()->put('email',$infoUser->email);
            $request->session()->put('role_id',$infoUser->rides_id);
            return redirect()->route('frontend.home');
        }else{
            return redirect()->back()->with('error_login','tai khoan khong ton tai');
        }
    }
}
