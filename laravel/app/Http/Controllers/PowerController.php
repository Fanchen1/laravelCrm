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
        if(empty($power['power_name'])){
            return $data=['status'=>1,'msg'=>'权限名称不能为空'];
        }
        if(empty($power['power_url'])){
            return $data=['status'=>1,'msg'=>'访问路径不能为空'];
        }

        if($power['power_id'] == 0){
            $data['power_level'] = 1;
        }else{
            $data['power_level'] = 2;
        }
        $data['power_name'] = $power['power_name'];
        $data['power_url'] = $power['power_url'];
        $data['power_status'] = $power['off'];
        $data['parent_id'] = $power['power_id'];
        $data['power_ctime'] = time();
       // print_r($data);exit;
        try{
            $res = DB::table('crm_power')->insertGetId($data);
            return $data=['status'=>1000,'msg'=>'添加成功'];
        }catch(\Exception $e){
            return $data=['status'=>1,'msg'=>'添加有误!.... '];
        }
    }

    //权限 展示
    public function PowerList()
    {
        $power=DB::table('crm_power')->get();
        $power = json_decode(json_encode($power),true);
        foreach($power as $k=>$v){
            $power[$k]['power_ctime'] = date('Y-m-d H:i:s',time());
            if($power[$k]['power_status'] == 1){
                $power[$k]['power_status'] = '启用';
            }else{
                $power[$k]['power_status'] = '暂不启用';
            }
        }
        return view('Power.PowerList', ['power' => $power]);
    }













}
