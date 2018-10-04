<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //客户添加 视图
    public  function userAdd(){
      //查 客户类型
        $type= DB::table('crm_user_type')->get();
        $type = json_decode(json_encode($type),true);

      //查 客户来源
        $source= DB::table('crm_user_source')->get();
        $source = json_decode(json_encode($source),true);

      //查 客户级别
        $rank= DB::table('crm_user_rank')->get();
        $rank = json_decode(json_encode($rank),true);

      //查 产品
        $product= DB::table('crm_product')->get();
        $product = json_decode(json_encode($product),true);

        return view('User.userAdd' , ['type'=>$type,'source'=>$source,'rank'=>$rank,'product'=>$product]);
    }
    //客户列表
    public function userList(Request $request){
        $user = DB::table('crm_user')
            ->join('crm_user_type','crm_user.type_id','=','crm_user_type.type_id')
            ->join('crm_user_source','crm_user.source_id','=','crm_user_source.source_id')
            ->join('crm_user_rank','crm_user.rank_id','=','crm_user_rank.rank_id')
            ->join('crm_product','crm_user.product_id','=','crm_product.product_id')
            ->where(['status'=>1])
            ->Paginate(3);//分页
        foreach($user as $k=>$v){
            $v->ctime = date('Y-m-d H:i:s',time());
        }
     //   print_r($user);

       // exit;
        return view('User.userList',['user'=>$user]);
    }
    //客户类型 执行添加
    public function userTypeDo(Request $request){
       $type =  $request -> input();
        unset($type['_token']);
        if(empty($type)){
            return $data=['status'=>1,'msg'=>'客户类型不能为空'];
        }
        $data['user_type'] = $type['type'];
        $data['type_status'] = 1;
        $data['ctime'] = time();
//        print_r($data);exit;
       $res= DB::table('crm_user_type')->insertGetId($data);
        if($res){
            return $data=['status'=>1000,];
        }else{
            return $data=['status'=>1,'msg'=>'保存失败'];
        }
    }
    //客户来源  执行添加
    public function userSourceDo(Request $request){
        $source =  $request -> input();
        unset($source['_token']);
        if(empty($source)){
            return $data=['status'=>1,'msg'=>'客户来源不能为空'];
        }
        $data['user_source'] = $source['source'];
        $data['source_status'] = 1;
        $data['ctime'] = time();
//        print_r($data);exit;
        $res= DB::table('crm_user_ source')->insertGetId($data);
        if($res){
            return $data=['status'=>1000,];
        }else{
            return $data=['status'=>1,'msg'=>'保存失败'];
        }

    }
    //客户  执行添加
    public function userAddDo(Request $request){
        $data = $request->input();
        if(empty($data)){
            return $data=['status'=>1,'msg'=>'数据请求失败'];
        }
        unset($data['_token']);

        if(empty($data['user_name'])){
            return $data=['status'=>1,'msg'=>'客户姓名不能为空'];
        }
        if(empty($data['user_tel'])){
            return $data=['status'=>1,'msg'=>'客户手机号不能为空'];
        }
        $tel_reg = '/^1\d{10}$/';
        if(!preg_match($tel_reg,$data['user_tel'])){
            return $data=['status'=>1,'msg'=>'手机号码格式不正确'];
        }
        if($data['rank'] == 0){
            return $data=['status'=>1,'msg'=>'请选择客户级别'];
        }
        if($data['product'] == 0){
            return $data=['status'=>1,'msg'=>'请选择产品'];
        }
        if(empty($data['user_address'])){
            return $data=['status'=>1,'msg'=>'请填写详情地址'];
        }
        if($data['type'] == 0){
            return $data=['status'=>1,'msg'=>'请选择客户类型'];
        }
        if($data['source'] == 0){
            return $data=['status'=>1,'msg'=>'请选择客户来源'];
        }


        $res['user_name'] = $data['user_name'];
        $res['user_tel'] = $data['user_tel'];
        $res['user_province'] = $data['user_province'];
        $res['user_city'] = $data['user_city'];
        $res['user_area'] = $data['user_area'];
        $res['user_address'] = $data['user_address'];
        $res['type_id'] = $data['type'];
        $res['source_id'] = $data['source'];
        $res['rank_id'] = $data['rank'];
        $res['product_id'] = $data['product'];
        $res['status'] = 1;
        $res['ctime'] = time();
        $res['utime'] = time();
         $user= DB::table('crm_user')->insert($res);
        if($user){
            return $data=['status'=>1000,'msg'=>'添加成功'];
        }else{
            return $data=['status'=>1,'msg'=>'添加有误，再试试吧！'];
        }

    }
    //客户 更新 视图
    public function userUpdate(Request $request){
        $id = $request ->input();
       $where_userId = [
           'user_id'=>$id,
           'status'=>1
       ];
        $user_name = DB::table('crm_user')
            ->join('crm_user_type','crm_user.type_id','=','crm_user_type.type_id')
            ->join('crm_user_source','crm_user.source_id','=','crm_user_source.source_id')
            ->join('crm_user_rank','crm_user.rank_id','=','crm_user_rank.rank_id')
            ->join('crm_product','crm_user.product_id','=','crm_product.product_id')
            ->where($where_userId)
            ->first();
       $user_name = json_decode(json_encode($user_name),true);
        //查 客户类型
        $type= DB::table('crm_user_type')->get();
        $type = json_decode(json_encode($type),true);

        //查 客户来源
        $source= DB::table('crm_user_source')->get();
        $source = json_decode(json_encode($source),true);

        //查 客户级别
        $rank= DB::table('crm_user_rank')->get();
        $rank = json_decode(json_encode($rank),true);

        //查 产品
        $product= DB::table('crm_product')->get();
        $product = json_decode(json_encode($product),true);

      //  print_r($user_name);
       return  view('User.userUpdate',['user_name'=>$user_name,'type'=>$type,'source'=>$source,'rank'=>$rank,'product'=>$product]);
    }
    //客户 执行 更新
    public function userUpdateDo(Request $request){
       $update = $request->input();
        unset($update['_token']);
        if(empty($update['user_name'])){
            return $data=['status'=>1,'msg'=>'客户姓名不能为空'];
        }
        if(empty($update['user_tel'])){
            return $data=['status'=>1,'msg'=>'客户手机号不能为空'];
        }
        $tel_reg = '/^1\d{10}$/';
        if(!preg_match($tel_reg,$update['user_tel'])){
            return $data=['status'=>1,'msg'=>'手机号码格式不正确'];
        }
        if($update['rank'] == 0){
            return $data=['status'=>1,'msg'=>'请选择客户级别'];
        }
        if($update['product'] == 0){
            return $data=['status'=>1,'msg'=>'请选择产品'];
        }
        if(empty($update['user_address'])){
            return $data=['status'=>1,'msg'=>'请填写详情地址'];
        }
        if($update['type'] == 0){
            return $data=['status'=>1,'msg'=>'请选择客户类型'];
        }
        if($update['source'] == 0){
            return $data=['status'=>1,'msg'=>'请选择客户来源'];
        }
        $Update_where = [
            'user_id' =>$update['user_id'],
            'status'=>1
        ];
        $Update = [
            'user_name'=>$update['user_name'],
            'user_tel'=>$update['user_tel'],
            'user_province'=>$update['user_province'],
            'user_city'=>$update['user_city'],
            'user_area'=>$update['user_area'],
            'user_address'=>$update['user_address'],
            'type_id'=>$update['type'],
            'source_id'=>$update['source'],
            'rank_id'=>$update['rank'],
            'product_id'=>$update['product'],
            'utime'=>time(),
        ];
        $res=  DB::table('crm_user')->where($Update_where)->update($Update);
        if($res){
            return $data=['status'=>1000,'msg'=>'修改成功'];
        }else{
            return $data=['status'=>1,'msg'=>'修改有误，再试试吧！'];
        }
    }
    //客户 假删除
    public function userDel(Request $request){
      $id =   $request->input();
        unset($id['_token']);
        $id = $id['id'];
        $where = [
          'user_id'=>$id,
          'status'=>1
        ];
        $Del = [
            'status'=>2,
            'utime'=>time()
        ];
        $res = DB::table('crm_user')->where($where)->update($Del);
        if($res){
            return $data=['status'=>1000,'msg'=>'删除成功'];
        }else{
            return $data=['status'=>1,'msg'=>'删除有误，再试试吧！'];
        }

    }




















    //评论
    public function comment(){
        $user = DB::table('user')->join('com','user_id=')-> get();
        $user = json_decode($user,true);



      //  print_r($user);exit;
        foreach( $user as $k => $v ){
            $where = ['user_id' => $v['user_id']];
            $data = DB::table('com') -> where( $where ) -> get();
            $data = json_decode($data,true);
            $user[$k]['com'] = $data;
        }



        return view('User.comment',['user' => $user]);
    }
}
