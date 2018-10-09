<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PactController extends Controller
{
    public function pactAdd(Request $request){
       $order_no=$request->get('order_no');
//        echo $order_no;
        $pact_no=$this->pactNo();
        $pacttypeList=DB::table('crm_pacttype')->get();
       return view('pactAdd',['pact_no'=>$pact_no,'pacttypeList'=>$pacttypeList,'order_no'=>$order_no]);
    }

    /**
     * 合同编号
     */
    public function pactNo(){
        $zi='HT';
        $date=date('YmdHis');
        $rand=rand(100,999);
        $pact_no=$zi.$date.$rand;
        return $pact_no;
    }
    /**
     * 合同分类添加
     */
    public function pact_add(){
        return view('pact_add');
    }
    /**
     * 执行合同分类添加
     */
    public function pact_add_name(Request $request){
        $pacttype_name=$request->post('pacttype_name');
        $add=[
            'pacttype_name'=>$pacttype_name
        ];
        $add_do=DB::table('crm_pacttype')->insert($add);
        if($add_do){
            return json_encode(['status'=>100,'msg'=>'添加成功']);
        }else{
            return json_encode(['status'=>1,'msg'=>'添加失败']);
        }
    }
    /**
     * 订单列表
     */
    public function orderList(){
        $order=DB::table('crm_order')->get();
        return view('pactOrderList',['page'=>$order]);
    }
    /**
     * 订单单条数据
     */
    public function pactFind(Request $request){
        $id=$request->post('id');
        $order=DB::table('crm_order')->where(['order_id'=>$id])->first();
        $order_find=json_decode(json_encode($order),true);
        $orderFind=$order_find['order_no'];
        return json_encode(['order'=>$orderFind]);
    }
    /**
     * 执行合同添加
     */
    public function pactAddAll(Request $request){
        $post=$request->post();
       // print_r($post);exit;
        $pact_stime=str_replace('T',' ',$post['pact_stime']);
        $pact_etime=str_replace('T',' ',$post['pact_etime']);
        $pact_stime=strtotime($pact_stime);
        $pact_etime=strtotime($pact_etime);
        $pact_add=[
            'pact_no'=>$post['pact_no'],
            'pacttype_id'=>$post['modules'],
            'order_id'=>$post['order_id'],
            'pact_stime'=>$pact_stime,
            'pact_etime'=>$pact_etime,
            'pact_payment'=>$post['pact_payment'],
            'pact_totalmoney'=>$post['pact_totalmoney'],
            'is_invoice'=>$post['is_invoice'],
            'is_tax'=>$post['is_tax'],
            'pact_contents'=>$post['pact_contents'],
            'pact_status'=>1,
            'pact_ctime'=>time(),

        ];
            $pactAdd=DB::table('crm_pact')->insert($pact_add);
            if($pactAdd){
                return json_encode(['status'=>100,'msg'=>'添加成功']);
            }else{
                return json_encode(['status'=>1,'msg'=>'添加失败']);
            }
    }
    /**
     * 合同列表展示
     */
    public function pactList(){
        $pact=DB::table('crm_pact')->join('crm_pacttype','crm_pact.pacttype_id','=','crm_pacttype.pacttype_id')->paginate(3);
        return view('pactList',['pact'=>$pact]);
    }
    /**
     * 审核
     */
//    public function audit(Request $request){
//        $id=$request->get('pact');
//        echo $id;exit;
//        $where=[
//            'status'=>2
//        ];
//        //DB::table('crm_pact')->where($where)->update();
//    }
/**
 * 删除
 */
    public  function pactDel(Request $request){
        $id=$request->post('id');
        $where=[
            'pact_status'=>3
        ];
        $pact=DB::table('crm_pact')->where(['pact'=>$id])->update($where);
        if($pact){
            return json_encode(['status'=>100,'msg'=>'删除成功']);
        }else{
            return json_encode(['staus'=>1,'msg'=>'删除失败']);
        }
    }
    /**
     * 修改页面
     */
    public function pact_update(Request $request){
        $id=$request->post('id');
        $pact_no=$this->pactNo();
        $pacttypeList=DB::table('crm_pacttype')->join('crm_pact','crm_pact.pacttype_id','=','crm_pacttype.pacttype_id')->where(['pact'=>$id])->first();
        $pact=DB::table('crm_pacttype')->get();
        $pacttypeList=json_decode(json_encode($pacttypeList),true);
        return view('pact_update',['pact_no'=>$pact_no,'pacttypeList'=>$pacttypeList,'pact'=>$pact]);
//        return view('pact_update');
    }
    /**
     * 执行修改
     */
    public function pactUpdate(Request $request){
        $id=$request->post('pact_id');
        $post=$request->post();
        $pact_stime=str_replace('T',' ',$post['pact_stime']);
        $pact_etime=str_replace('T',' ',$post['pact_etime']);
        $pact_stime=strtotime($pact_stime);
        $pact_etime=strtotime($pact_etime);
        $pact_update=[
            'pact_no'=>$post['pact_no'],
            'pacttype_id'=>$post['modules'],
            'order_id'=>$post['order_id'],
            'pact_stime'=>$pact_stime,
            'pact_etime'=>$pact_etime,
            'pact_payment'=>$post['pact_payment'],
            'pact_totalmoney'=>$post['pact_totalmoney'],
            'is_invoice'=>$post['is_invoice'],
            'is_tax'=>$post['is_tax'],
            'pact_contents'=>$post['pact_contents'],
            'pact_utime'=>time(),
        ];
        $update=DB::table('crm_pact')->where(['pact'=>$id])->update($pact_update);
        if($update){
            return json_encode(['status'=>100,'msg'=>'修改成功']);
        }else{
            return json_encode(['status'=>1,'msg'=>'修改成功']);
        }
    }
}
