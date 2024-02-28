<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $keyword=$request->s;
        $admin=Account::where('role_id',1)
                        ->where('last_name','LIKE',"%{$keyword}%")
                        ->orderBy('id','desc')
                        ->get();
        return view('admin.user.index',[
            'admins'=>$admin,
            'keyword'=>$keyword
        ]);
    }
    public function add(){
        return view('admin.user.add');
    }
    public function create(UserPostRequest $request){
       $nameImg='';
        if($request->hasFile('avatar')){
        
            $validate=Validator::make(
                $request->all(),
                [
                    'avatar'=>['max:2048','mimes:png,jpg,svg'],
                ],
                [
                    'avatar.max'=>'kich thuoc size qua lon',
                    'avatar.mimes'=>'anh sai dinh dang'
                ]

                );
            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $img=$request->file('avatar');
            $nameImg=time().$img->getClientOriginalName();
            $img->move(public_path('upload/images/user'),$nameImg);
        }

       $data=[
        'username'=>$request->username,
        'password'=>Hash::make($request->password),
        'email'=>$request->email,
        'phone'=>$request->phone,
        'gender'=>$request->gender,
        'address'=>$request->address,
        'role_id'=>1,
        'status'=>$request->status,
        'birthday'=>$request->birthday,
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'avatar'=>$nameImg
       ];
       $user=Account::insert($data);
       if($user){
        return redirect()->route('admin.user')->with('insert_success', 'insert success');
       }
    }
    public function delete(Request $request){
        $id=$request->id;
        $account=Account::find($id);
        if($account){
            $account->delete();
            return redirect()->route('admin.user')->with('delete_success', 'delete success');
        }

    }
    public function edit(Request $request){
        $id=$request->id;
        $account=Account::find($id);
        return view('admin.user.edit',['account'=>$account]);
    }
    public function update(UserUpdateRequest $request){
        $id=$request->id;
        $nameImg='';
        if($request->hasFile('avatar')){
        
            $validate=Validator::make(
                $request->all(),
                [
                    'avatar'=>['max:2048','mimes:png,jpg,svg'],
                ],
                [
                    'avatar.max'=>'kich thuoc size qua lon',
                    'avatar.mimes'=>'anh sai dinh dang'
                ]

                );
            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $img=$request->file('avatar');
            $nameImg=time().$img->getClientOriginalName();
            $img->move(public_path('upload/images/user'),$nameImg);
        }
        if(!empty($nameImg)){
            $data=[
                'username'=>$request->username,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'role_id'=>1,
                'status'=>$request->status,
                'birthday'=>$request->birthday,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'avatar'=>$nameImg
               ];
        }else{
            $data=[
                'username'=>$request->username,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'role_id'=>1,
                'status'=>$request->status,
                'birthday'=>$request->birthday,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name
               
               ];
        }

      
       $user=Account::where('id',$id)->update($data);
       if($user){
        return redirect()->route('admin.user')->with('update_success', 'update thanh cong');
       }
    }
}
