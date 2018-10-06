<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class AftersaleController extends Controller
{
    //售后列表
    public function aftersaleList(){
        $aftersale = DB::table('crm_aftersale')
            ->join('crm_product','crm_aftersale.product_id','=','crm_product.product_id')
            ->join('crm_user','crm_aftersale.user_id','=','crm_user.user_id')
            ->join('crm_aftersale_classify','crm_aftersale.classify_id','=','crm_aftersale_classify.classify_id')
            ->where(['crm_aftersale.status'=>1])
            ->paginate(3);
          foreach($aftersale as $k=>$v){
              $v->aftersale_time  = date('Y-m-t',time());
              $v->aftersale_ctime  = date('Y-m-t ',time());
              if($v->is_solve == 1 ){ //是否解决
                  $v->is_solve = '待解决';
              }else{
                  $v->is_solve = '已解决';
              }//结束时间
              if(!$v->result_time == ''){
                  $v->result_time  = date('Y-m-t',time());
              }else{
                  $v->result_time  =  '还未处理哦！';
              } //处理结果
              if($v->result == ''){
                  $v->result  =  '还未处理哦！';
              }
              //修改时间
              if(!$v->aftersale_utime == ''){
                  $v->aftersale_utime  = date('Y-m-t ',time());
              }else{
                  $v->aftersale_utime  =  '还未修改哦！';
              }
          }



        return view('Aftersale.aftersaleList',['aftersale'=>$aftersale]);
    }
    //售后 添加
    public function aftersaleAdd(){
        //查 产品
        $product= DB::table('crm_product')->get();
        $product = json_decode(json_encode($product),true);
        //查 反馈分类
        $classify= DB::table('crm_aftersale_classify')->get();
        $classify = json_decode(json_encode($classify),true);
        //查 联系人
        $user_name= DB::table('crm_user')->select('user_id','user_name')->get();
        $user_name = json_decode(json_encode($user_name),true);
        return view('Aftersale.aftersaleAdd',['product'=>$product,'classify'=>$classify,'user_name'=>$user_name]);
    }
    //售后 处理
    public function dispose(Request $request){
        $id=$request->input('id');
       $where = [
         'aftersale_id'=>$id
       ];
        //查 产品
        $product= DB::table('crm_product')->get();
        $product = json_decode(json_encode($product),true);
        //查 反馈分类
        $classify= DB::table('crm_aftersale_classify')->get();
        $classify = json_decode(json_encode($classify),true);
        //查 联系人
        $user_name= DB::table('crm_user')->select('user_id','user_name')->get();
        $user_name = json_decode(json_encode($user_name),true);

        //查 映射
        $aftersale = DB::table('crm_aftersale')
            ->join('crm_product','crm_aftersale.product_id','=','crm_product.product_id')
            ->join('crm_user','crm_aftersale.user_id','=','crm_user.user_id')
            ->join('crm_aftersale_classify','crm_aftersale.classify_id','=','crm_aftersale_classify.classify_id')
            ->where($where)
            ->first();
        $aftersale = json_decode(json_encode($aftersale),true);

        $aftersale['aftersale_time']  = date('Y-m-t',time());
        //结束时间
        if(!$aftersale['result_time'] == ''){
            $aftersale['result_time']  = date('Y-m-t',time());
        }

        return view('Aftersale.dispose',['product'=>$product,'classify'=>$classify,'user_name'=>$user_name,'aftersale'=>$aftersale]);
    }
    //售后 修改视图
    public function aftersaleUpdate(Request $request){
        $id=$request->input('id');
        $where = [
            'aftersale_id'=>$id
        ];
        //查 产品
        $product= DB::table('crm_product')->get();
        $product = json_decode(json_encode($product),true);
        //查 反馈分类
        $classify= DB::table('crm_aftersale_classify')->get();
        $classify = json_decode(json_encode($classify),true);
        //查 联系人
        $user_name= DB::table('crm_user')->select('user_id','user_name')->get();
        $user_name = json_decode(json_encode($user_name),true);

        //查 映射
        $aftersale = DB::table('crm_aftersale')
            ->join('crm_product','crm_aftersale.product_id','=','crm_product.product_id')
            ->join('crm_user','crm_aftersale.user_id','=','crm_user.user_id')
            ->join('crm_aftersale_classify','crm_aftersale.classify_id','=','crm_aftersale_classify.classify_id')
            ->where($where)
            ->first();
        $aftersale = json_decode(json_encode($aftersale),true);

        $aftersale['aftersale_time']  = date('Y-m-t',time());
        //结束时间
        if(!$aftersale['result_time'] == ''){
            $aftersale['result_time']  = date('Y-m-t',time());
        }

        return view('Aftersale.aftersaleUpdate',['product'=>$product,'classify'=>$classify,'user_name'=>$user_name,'aftersale'=>$aftersale]);

    }
    //售后 执行反馈分类添加
    public function aftersaleClassifyDo(Request $request){
        $classify =  $request -> input();
        unset($classify['_token']);
        if(empty($classify)){
            return $data=['status'=>1,'msg'=>'反馈分类不能为空'];
        }

        $data['aftersale_classify'] = $classify['classify'];

        $res= DB::table('crm_aftersale_classify')->insertGetId($data);
        if($res){
            return $data=['status'=>1000,];
        }else{
            return $data=['status'=>1,'msg'=>'保存失败'];
        }
    }
    //售后 执行 --添加
    public function aftersaleAddDo(Request $request){
        $aftersale = $request ->input();
        unset($aftersale['_token']);
      //  print_r($aftersale);exit;
       // ---  后台拦截 ------   优化时    --- 注意填写后台拦截
        if($aftersale['is_solve'] == 1){
            //添加字段
            $aftersale['aftersale_time'] = strtotime($aftersale['aftersale_time']);
            $data['product_id'] = $aftersale['product_id'];
            $data['aftersale_issue'] = $aftersale['aftersale_issue'];
            $data['user_id'] = $aftersale['user_id'];
            $data['classify_id'] = $aftersale['classify_id'];
            $data['aftersale_time'] = $aftersale['aftersale_time'];
            $data['aftersale_contents'] = $aftersale['aftersale_contents'];
            $data['is_solve'] = $aftersale['is_solve'];
            $data['status']=1;
            $data['aftersale_ctime'] = time();
        }else{
            //添加字段
            $aftersale['result_time'] = strtotime($aftersale['result_time']);
            $data['product_id'] = $aftersale['product_id'];
            $data['aftersale_issue'] = $aftersale['aftersale_issue'];
            $data['user_id'] = $aftersale['user_id'];
            $data['classify_id'] = $aftersale['classify_id'];
            $data['aftersale_time'] = $aftersale['aftersale_time'];
            $data['aftersale_contents'] = $aftersale['aftersale_contents'];
            $data['is_solve'] = $aftersale['is_solve'];
            $data['result_time'] = $aftersale['result_time'];
            $data['result'] = $aftersale['result'];
            $data['status']=1;
            $data['aftersale_ctime'] = time();
        }
       $res = DB::table('crm_aftersale')->insertGetId($data);
        if($res){
            return $data=['status'=>1000,];
        }else{
            return $data=['status'=>1,'msg'=>'保存失败'];
        }




    }
    //售后 执行 处理修改
    public function disposeDo(Request $request){
       $dispose =  $request->input();
        unset($dispose['_token']);
        //print_r($dispose);
        $where = [
          'aftersale_id'=>$dispose['id']
        ];
        $update = [
            'is_solve'=>$dispose['is_solve'],
            'result_time'=>strtotime($dispose['result_time']),
            'result'=>$dispose['result'],
            'aftersale_utime'=>time()
        ];
        $res=  DB::table('crm_aftersale')->where($where)->update($update);
        if($res){
            return $data=['status'=>1000,'msg'=>'修改成功'];
        }else{
            return $data=['status'=>1,'msg'=>'修改有误，再试试吧！'];
        }
    }
    //售后 执行 修改
    public function aftersaleUpdateDo(Request $request){
        $aftersaleUpdate = $request->input();
        unset($aftersaleUpdate['_token']);
        $where = [
            'aftersale_id'=>$aftersaleUpdate['id']
        ];
        $update = [
            'result_time' => strtotime($aftersaleUpdate['result_time']),
            'product_id' => $aftersaleUpdate['product_id'],
            'aftersale_issue' => $aftersaleUpdate['aftersale_issue'],
           'user_id'=> $aftersaleUpdate['user_id'],
            'classify_id' => $aftersaleUpdate['classify_id'],
            'aftersale_time' => strtotime($aftersaleUpdate['aftersale_time']),
            'aftersale_contents' => $aftersaleUpdate['aftersale_contents'],
            'is_solve'=>$aftersaleUpdate['is_solve'],
            'result'=>$aftersaleUpdate['result'],
            'aftersale_utime'=>time()
        ];
        $res=  DB::table('crm_aftersale')->where($where)->update($update);
        if($res){
            return $data=['status'=>1000,'msg'=>'修改成功'];
        }else{
            return $data=['status'=>1,'msg'=>'修改有误，再试试吧！'];
        }
    }
    //售后 执行 假删除
    public function aftersaleDel(Request $request){
        $id =   $request->input();
        unset($id['_token']);
        $id = $id['id'];
        $where = [
            'aftersale_id'=>$id,
        ];
        $Del = [
            'status'=>2,
            'aftersale_utime'=>time()
        ];
        $res = DB::table('crm_aftersale')->where($where)->update($Del);
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }
    }



}
