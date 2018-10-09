<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class FrameController extends Controller
{

    //客户类型 列表
    public function Type(){
        $type= DB::table('crm_user_type')->get();
        $type = json_decode(json_encode($type),true);
        return view('Frame.FrameType',['type'=>$type,]);
    }
    //客户类型 删除--
    public function TypeDo(Request $request){
        $id =   $request->input('id');
        $where = [
            'type_id'=>$id,
        ];
        $res = DB::table('crm_user_type')->where($where)->delete();
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }

    //客户来源 列表
    public function Source(){
        $source= DB::table('crm_user_source')->get();
        $source = json_decode(json_encode($source),true);
        return view('Frame.FrameSource',['source'=>$source,]);
    }
    //客户来源 删除--
    public function SourceDo(Request $request){
        $id =   $request->input('id');
        $where = [
            'source_id'=>$id,
        ];
        $res = DB::table('crm_user_source')->where($where)->delete();
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }

    //跟单类型 列表
    public function Type_data(){
        $type_data = DB::table('tailorder_type')->get();
        $type_data = json_decode(json_encode($type_data),true);
        return view('Frame.FrameType_data',['type_data'=>$type_data,]);
    }
    //跟单类型 删除--
    public function Type_dataDo(Request $request){
        $id =   $request->input('id');
        $where = [
            'tailorder_type_id'=>$id,
        ];
        $res = DB::table('tailorder_type')->where($where)->delete();
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }

    //跟单进度 列表
    public function Plan_data(){
        $plan_data = DB::table('tailorder_plan')->get();
        $plan_data = json_decode(json_encode($plan_data),true);
        return view('Frame.FramePlan_data',['plan_data'=>$plan_data,]);
    }
    //跟单进度 删除--
    public function Plan_dataDo(Request $request){
        $id =   $request->input('id');
        $where = [
            'tailorder_plan_id'=>$id,
        ];
        $res = DB::table('tailorder_plan')->where($where)->delete();
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }

    //费用 类型 列表
    public function Costtype_data(){
        $costtype_data = DB::table('cost_type')->get();
        $costtype_data = json_decode(json_encode($costtype_data),true);
        return view('Frame.FrameCosttype_data',['costtype_data'=>$costtype_data,]);
    }
    //反顾分类 删除--
    public function Costtype_dataDo(Request $request){
        $id =   $request->input('id');
        $where = [
            'cost_type_id'=>$id,
        ];
        $res = DB::table('cost_type')->where($where)->delete();
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }


    //反顾分类
    public function Classify(){
        $classify= DB::table('crm_aftersale_classify')->get();
        $classify = json_decode(json_encode($classify),true);
        return view('Frame.FrameClassify',['classify'=>$classify,]);
    }
    //反顾分类 删除--
    public function ClassifyDo(Request $request){
        $id =   $request->input('id');
        $where = [
            'classify_id'=>$id,
        ];
        $res = DB::table('crm_aftersale_classify')->where($where)->delete();
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }

















}
