<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    //角色列表
    public function RoleList(){
        return view('Role.RoleList');
    }
    //角色添加
    public function RoleAdd(){
        $parent =  DB::table('crm_power')->where(['parent_id'=>0])->get();
        $parent =  json_decode(json_encode($parent),true);
      $power =  DB::table('crm_power')->get();
      $power =  json_decode(json_encode($power),true);

      $new = [];
      foreach($power as $k=>$v){
          $new[$v['power_id']] = $v;
      }
      foreach($new as $kk=>$vv){
            if($vv['parent_id'] !=0 ){
                $new[$vv['parent_id']]['son'][]= &$new[$kk  ];
                unset($new[$kk]);
            }
      }
        return view('Role.RoleAdd',['power'=>$new,'parent'=>$parent]);
    }















}
