<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    /**
     * 展示订单添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function orderAdd(){
        $order_no=$this->order_no();
        return view('order_add',['order_no'=>$order_no]);
    }

    /**
     * 生成订单编号
     * @return string
     */
    public function order_no(){
        $letter='DD';
        $date=date('ymdhis');
        $rand=mt_rand(1000,9999);
        $no=$letter.$date.$rand;
        return $no;
    }

    /**
     * 执行添加
     */
    public function order_add(Request $request){
        $session=session('user.id');
        $session_admin=session('user.account');
        //print_r($session);
        $post=$request->post();
      //  print_r($post);exit;
        $order_stime=$post['order_stime'];
        $order_stime=str_replace('T',' ',$order_stime);
        $order_etime=$post['order_etime'];
        $order_etime=str_replace('T',' ',$order_etime);
        $order_etime=strtotime($order_etime);
        $order_stime=strtotime($order_stime);
        if($order_stime >= $order_etime){
            return json_encode(['status'=>1,'msg'=>'交单日期不能小于下单日期']);
        }
        $order=[
            'order_no'=>$this->order_no(),
            'user_id'=>$session,
            'order_stime'=>$order_stime,
            'order_etime'=>$order_etime,
            'order_imprest'=>$post['order_imprest'],
            'order_price'=>$post['order_price'],
            'order_status'=>1,
            'order_contents'=>$post['order_contents'],
            'admin_id'=>$session_admin,
            'order_ctime'=>time(),
        ];
        $crmOrder=\Illuminate\Support\Facades\DB::table('crm_order')->insert($order);
        if($crmOrder){
            return json_encode(['status'=>100,'msg'=>'添加成功']);
        }else{
            return json_encode(['status'=>1,'msg'=>'添加失败']);
        }
    }

    /**
     * 管理员id
     */
    public function adminSession(Request $request){
        $session=session('user.id');
        print_r($session);
    }
    /**
     * 订单展示
     */
    public function order_list(){
        $orderList=DB::table('crm_order')->get();
        $orderList=json_decode(json_encode($orderList),true);
        foreach($orderList as $k=>$v){
            $orderList[$k]['order_stime']=date('Y-m-d H:i:s',$v['order_stime']);
            $orderList[$k]['order_etime']=date('Y-m-d H:i:s',$v['order_etime']);
            $orderList[$k]['order_ctime']=date('Y-m-d H:i:s',$v['order_ctime']);
        }
        $page=DB::table('crm_order')->simplePaginate(3);
        //$page=json_decode(json_encode($page),true);
//       print_r($page);exit;
//        foreach($page as $k=>$v){
//            $page['data']['order_stime']=date('Y-m-d H:i:s',$v['order_stime']);
//            $page['data']['order_etime']=date('Y-m-d H:i:s',$v['order_etime']);
//            $page['data']['order_ctime']=date('Y-m-d H:i:s',$v['order_ctime']);
//        }
        return view('orderList',['orderList'=>$orderList,'page'=>$page]);
    }
}
