<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\input;

class CostController extends Controller{
    //展示
    public function costList(){
        $cost_data = DB::table('crm_cost')
            ->join('cost_type','crm_cost.cost_type_id','=','cost_type.cost_type_id')
            ->join('crm_user','crm_user.user_id','=','crm_cost.user_id')
            ->select('crm_cost.*', 'crm_user.user_name','cost_type.cost_type_name')
            ->where(['admin_id'=>session('user.id'),'cost_status'=>1])
            ->paginate(5);
        $count = DB::table('crm_cost')->where(['admin_id'=>session('user.id'),'cost_status'=>1])->count();

        foreach($cost_data as $k=>$v){
            $v->cost_time=date('Y-m-d H:i:s',$v->cost_time);
            $v->admin_name=session('user.account');
        }
        return view('cost/costList',['cost_data'=>$cost_data,'count'=>$count]);
    }
    //添加
    public function costAdd(){
        $user_data = DB::table('crm_user')->get();
        $user_data = json_decode(json_encode($user_data),true);
        $costtype_data = DB::table('cost_type')->get();
        $costtype_data = json_decode(json_encode($costtype_data),true);

        $obj = new \Memcache();
        $obj->connect('127.0.0.1','11211');
        $costtype = $obj->get('costtype');
        return view('cost/costAdd',[
            'user_data'=>$user_data,
            'costtype_data'=>$costtype_data,
            'costtype'=>$costtype
        ]);
    }
    //执行添加
    public function costAddDo(){
        $data = input::all();
        $time = strtotime($data['cost_time']);
        $crm_cost=[
            'cost_type'=>$data['type'],
            'cost_type_id'=>$data['cost_type_id'],
            'cost_money'=>$data['price'],
            'cost_time'=>$time,
            'user_id'=>$data['username'],
            'cost_contents'=>$data['contents'],
            'cost_ctime'=>time(),
            'admin_id'=>session('user.id')
        ];
        $res = DB::table('crm_cost')->insertGetId($crm_cost);
        if($res){
            $obj = new \Memcache();
            $obj->connect('127.0.0.1','11211');
            $obj->set('costtype','');
            return $this->win('添加成功');
        }else{
            return $this->fail('添加失败');
        }
    }


    public function costDel(){
        $id = input::post('id');
        $res = DB::table('crm_cost')
            ->where(['cost_id'=>$id])
            ->update(['cost_status'=>2,'cost_utime'=>time()]);
        if($res){
            return $this->win('成功');
        }else{
            return $this->fail('失败');
        }

    }
    //批删
    public function costDelAll(){
        $id = input::post('id');
        $id = explode(',',$id);
        $res = DB::table('crm_cost')
            ->whereIn('cost_id',$id)
            ->update(['cost_status'=>2,'cost_utime'=>time()]);
        if($res){
            return $this->win('成功');
        }else{
            return $this->fail('失败');
        }
    }


    //费用类型添加
    public function costTypeAdd(){
        return view('cost/costTypeAdd');
    }
    //执行费用类型添加
    public function costTypeAddDo(){
        $typename=input::post('typename');
        if(empty($typename)){
            return $this->fail('参数不能为空');
        }
        $info = DB::table('cost_type')->where(['cost_type_name'=>$typename])->first();
        if(!empty($info)){
            return $this->fail('该数据已存在，换个试试');
        }
        $data = [
            'cost_type_name'=>$typename,
            'cost_type_ctime'=>time()
        ];
        $res = DB::table('cost_type')->insertGetId($data);
        if($res){

            $obj = new \Memcache();
            $obj->connect('127.0.0.1','11211');
            $costtype=$obj->get('costtype');
            $costtype['type']=$typename;
            $obj->set('costtype',$costtype,0);
            return $this->win('保存成功');
        }else{
            return $this->fail('保存失败');
        }
    }


    //修改
    public function costUpd(){
        $user_data = DB::table('crm_user')->get();
        $user_data = json_decode(json_encode($user_data),true);
        $costtype_data = DB::table('cost_type')->get();
        $costtype_data = json_decode(json_encode($costtype_data),true);
        $id = input::get('id');
        $cost_data = DB::table('crm_cost')->where(['cost_id'=>$id,'admin_id'=>session('user.id')])->first();
//        $obj = new \Memcache();
//        $obj->connect('127.0.0.1','11211');
//        $costtype = $obj->get('costtype');
        return view('cost/costUpd',[
            'user_data'=>$user_data,
            'costtype_data'=>$costtype_data,
            'cost_data'=>$cost_data
        ]);
    }
    public function costUpdDo(){
        $data = input::all();
        $time = strtotime($data['cost_time']);
        $crm_cost=[
            'cost_type'=>$data['type'],
            'cost_type_id'=>$data['cost_type_id'],
            'cost_money'=>$data['price'],
            'cost_time'=>$time,
            'user_id'=>$data['username'],
            'cost_contents'=>$data['contents'],
            'cost_utime'=>time(),
        ];
        $res = DB::table('crm_cost')
            ->where(['cost_id'=>$data['id'],'admin_id'=>session('user.id')])
            ->update($crm_cost);
        if($res){
            return $this->win('修改成功');
        }else{
            return $this->fail('修改失败');
        }
    }





    /**
     * 封装成功方法
     */
    public function win($msg='ok',$data=[]){
        return json_encode(
            [
                'msg' => $msg,
                'status' => '1000',
                'data'=>$data
            ]
        );
    }

    /**
     * 封装失败方法
     */
    private function fail($msg='no',$data=[]){
        return json_encode(
            [
                'msg' => $msg,
                'status' => '1',
                'data'=>$data
            ]
        );
    }
}
