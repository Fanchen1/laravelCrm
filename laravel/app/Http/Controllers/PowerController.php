<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PowerController extends Controller
{
    //权限添加
    public function PowerAdd(){
        //查出所有的父级
        $where = [
            'power_status'=>1,
            'parent_id'=>0,
        ];
       $parent =  DB::table('crm_power')->where($where)->get();
        $parent = json_decode(json_encode($parent),true);
        return view('Power.PowerAdd',['parent'=>$parent]);
    }
    //权限 执行 添加
    public function PowerAddDo(Request $request){
        $power = $request ->input();
        unset($power['_token']);
        print_r($power);
    }
    //权限 展示
    public function PowerList()
    {
        echo 1111;
        return view('Power.PowerList', ['user' => []]);

    }













}
