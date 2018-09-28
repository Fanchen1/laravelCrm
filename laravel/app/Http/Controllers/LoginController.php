<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function checkLogin(Request $request){
        $username=$request->post('username');
        if(empty($username)){
            return json_encode(['status'=>1,'msg'=>'账号不能为空']);
        }
        $pwd=$request->post('pwd');
        if(empty($pwd)){
            return json_encode(['status'=>1,'msg'=>'密码不能为空']);
        }
        $where=[
            'account'=>$username
        ];
        $user=DB::table('crm_admin')->where($where)->first();
        $user=json_decode(json_encode($user),true);
        if($username!=$user['account']){
            return json_encode(['status'=>1,'msg'=>'该用户不存在，请重新输入']);
        }
        $md5=md5($pwd);
        //echo $md5;exit;
        if($md5!=$user['pwd']){
            return json_encode(['status'=>1,'msg'=>'账号或密码不正确，请重新输入']);
        }else{
//            $session=session(['user'=>$user]);
            Session::put('user',$user);
//            $session=session('user');
            return json_encode(['status'=>100]);
        }
    }
}
