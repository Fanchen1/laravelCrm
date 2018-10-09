<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\input;

class TailorderController extends Controller{
    /**
     *跟单添加
     */
    public function tailorderAdd(){
        $type_data = DB::table('tailorder_type')->get();
        $type_data = json_decode(json_encode($type_data),true);
        $plan_data = DB::table('tailorder_plan')->get();
        $plan_data = json_decode(json_encode($plan_data),true);
        $user_data = DB::table('crm_user')->get();
        $user_data = json_decode(json_encode($user_data),true);
        $obj = new \Memcache();
        $obj->connect('127.0.0.1','11211');
        $tailorder = $obj->get('tailorder');
//        print_r($tailorder);
        return view('tailorder/tailorderAdd',
            ['type_data'=>$type_data,'plan_data'=>$plan_data,'user_data'=>$user_data,'tailorder'=>$tailorder]
        );
    }

    public function tailorderAddDo(){
        $data = input::all();
        $time = strtotime($data['time']);
        if($time<time()){
            return $this->fail('下次联系时间不能小于当前时间');
        }
        $tailorder_data=[
            'tailorder_type_id'=>$data['type'],
            'tailorder_plan_id'=>$data['plan'],
            'user_id'=>$data['username'],
            'admin_id'=>session('user.id'),
            'tailorder_contents'=>$data['contents'],
            'time'=>$time,
            'tailorder_ctime'=>time()
        ];
//        print_r($tailorder_data);
        $res = DB::table('crm_tailorder')->insertGetId($tailorder_data);
        if($res){
            $obj = new \Memcache();
            $obj->connect('127.0.0.1','11211');
            $obj->set('tailorder','');
            return $this->win('添加成功');
        }else{
            return $this->fail('添加失败');
        }
    }



    /**
     * 跟单展示
     */
    public function tailorderList(){

        $tailorder_data = DB::table('crm_tailorder')
            ->join('tailorder_plan','crm_tailorder.tailorder_plan_id','=','tailorder_plan.tailorder_plan_id')
            ->join('tailorder_type','crm_tailorder.tailorder_type_id','=','tailorder_type.tailorder_type_id')
            ->join('crm_user','crm_user.user_id','=','crm_tailorder.user_id')
            ->select('crm_tailorder.*', 'crm_user.user_name','tailorder_plan.tailorder_plan_name','tailorder_type.tailorder_type_name')
            ->where(['admin_id'=>session('user.id'),'tailorder_status'=>1])
            ->paginate(5);
        $count = DB::table('crm_tailorder')->where(['admin_id'=>session('user.id'),'tailorder_status'=>1])->count();

//        $tailorder_data = json_decode(json_encode($tailorder_data),true);
//        print_r($tailorder_data);exit;
        foreach($tailorder_data as $k=>$v){
            $v->time=date('Y-m-d H:i:s',$v->time);
            $v->admin_name=session('user.account');
        }




        return view('tailorder/tailorderList',[
            'tailorder_data'=>$tailorder_data,
            'count'=>$count
        ]);
    }
    //单删
    public function tailorderDel(){
        $id = input::post('id');
        $res = DB::table('crm_tailorder')
                ->where(['tailorder_id'=>$id])
                ->update(['tailorder_status'=>2,'tailorder_utime'=>time()]);
        if($res){
            return $this->win('成功');
        }else{
            return $this->fail('失败');
        }

    }
    //批删
    public function tailorderDelAll(){
        $id = input::post('id');
        $id = explode(',',$id);
        $res = DB::table('crm_tailorder')
            ->whereIn('tailorder_id',$id)
            ->update(['tailorder_status'=>2,'tailorder_utime'=>time()]);
        if($res){
            return $this->win('成功');
        }else{
            return $this->fail('失败');
        }
    }
    //修改
    public function tailorderUpd(){
        $type_data = DB::table('tailorder_type')->get();
        $type_data = json_decode(json_encode($type_data),true);
        $plan_data = DB::table('tailorder_plan')->get();
        $plan_data = json_decode(json_encode($plan_data),true);
        $user_data = DB::table('crm_user')->get();
        $user_data = json_decode(json_encode($user_data),true);
        $obj = new \Memcache();
        $obj->connect('127.0.0.1','11211');
        $tailorder = $obj->get('tailorder');
//        print_r($tailorder);
        $id = input::get('id');
        $tailorder_data = DB::table('crm_tailorder')
            ->where(['tailorder_id'=>$id])
            ->first();
        $tailorder_data=json_decode(json_encode($tailorder_data),true);
        return view('tailorder/tailorderUpd',
            [
                'type_data'=>$type_data,
                'plan_data'=>$plan_data,
                'user_data'=>$user_data,
                'tailorder'=>$tailorder,
                'tailorder_data'=>$tailorder_data
            ]
        );
    }
    //执行修改
    public function tailorderUpdDo(){
        $data = input::all();
        $time = strtotime($data['time']);
        if($time<time()){
            return $this->fail('下次联系时间不能小于当前时间');
        }
        $tailorder_data=[
            'tailorder_type_id'=>$data['type'],
            'tailorder_plan_id'=>$data['plan'],
            'user_id'=>$data['username'],
            'admin_id'=>session('user.id'),
            'tailorder_contents'=>$data['contents'],
            'time'=>$time,
            'tailorder_utime'=>time()
        ];
//        print_r($tailorder_data);exit;
        $res = DB::table('crm_tailorder')
            ->where(['tailorder_id'=>$data['id']])
            ->update($tailorder_data);
        if($res){
            return $this->win('修改成功');
        }else{
            return $this->fail('修改失败');
        }
    }


    /** 跟单类型添加 */
    public function tailorderTypeAdd(){
        return view ('tailorder/tailorderTypeAdd');
    }
    public function tailorderTypeAddDo(){
        $typename=input::post('typename');
        if(empty($typename)){
            return $this->fail('参数不能为空');
        }
        $info = DB::table('tailorder_type')->where(['tailorder_type_name'=>$typename])->first();
        if(!empty($info)){
            return $this->fail('该数据已存在，换个试试');
        }
        $data = [
            'tailorder_type_name'=>$typename,
            'tailorder_type_ctime'=>time()
        ];
        $res = DB::table('tailorder_type')->insertGetId($data);
        if($res){

            $obj = new \Memcache();
            $obj->connect('127.0.0.1','11211');
            $tailorder=$obj->get('tailorder');
            $tailorder['type']=$typename;
            $obj->set('tailorder',$tailorder,0);
            return $this->win('保存成功');
        }else{
            return $this->fail('保存失败');
        }
    }
    /** 跟单进度添加 */
    public function tailorderPlanAdd(){
        return view ('tailorder/tailorderPlanAdd');
    }
    public function tailorderPlanAddDo(){
        $planname=input::post('planname');
        if(empty($planname)){
            return $this->fail('参数不能为空');
        }
        $info = DB::table('tailorder_plan')->where(['tailorder_plan_name'=>$planname])->first();
        if(!empty($info)){
            return $this->fail('该数据已存在，换个试试');
        }
        $data = [
            'tailorder_plan_name'=>$planname,
            'tailorder_plan_ctime'=>time()
        ];
        $res = DB::table('tailorder_plan')->insertGetId($data);
        if($res){
            $obj = new \Memcache();
            $obj->connect('127.0.0.1','11211');
            $tailorder=$obj->get('tailorder');
            $tailorder['plan']=$planname;
            $obj->set('tailorder',$tailorder,0);
            return $this->win('保存成功');
        }else{
            return $this->fail('保存失败');
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

?>