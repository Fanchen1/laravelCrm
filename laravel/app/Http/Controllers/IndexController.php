<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * 管理员后台展示+防非法登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function index(Request $request){
        if(empty(session('user'))) {
            $request->session()->flush('user');
            return redirect('/');
        }else{
            $user=session('user.account');
            return view('index',['user'=>$user]);
        }

    }
    public function welcome(Request $request){
        if(empty(session('user'))) {
            $request->session()->flush('user');
            return redirect('/');
        }else{
            $user=session('user.account');
<<<<<<< HEAD
//            $city='河北';
=======
            $city='河北';
>>>>>>> 1d2c295046ecd4b56168ddeb684cb0714e1b9673
//            $weather=$this->weather($city);
            return view('welcome',['user'=>$user]);

        }
    }

    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Laravel\Lumen\Http\Redirector|\think\response\Redirect|void
     */
    public function quit(Request $request){
        $request->session()->flush('user');
        return redirect('/');
    }

    /**
     * 百度翻译
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function translate(Request $request){
        return view('translate');
    }
    /**
     * 调用翻译件接口
     */
    public function translateApi(Request $request){
        $value_code=$request->get('qian');
        $obj=new \Memcache();
<<<<<<< HEAD
        $obj->connect('127.0.0.1','11211');
        $git=$obj->get('git');
        if(!empty($git[$value_code])){
            $hou=$git[$value_code];
        }else{
            $from='auto';
            $to='auto';
            $appid='20180929000213734';
            $salt=rand(10000,99999);
            $key='9qgjzWHTYglWiDosdEAW';
            $sign=md5($appid.$value_code.$salt.$key);
            $data=[
                'q'=>$value_code,
                'from'=>$from,
                'to'=>$to,
                'appid'=>$appid,
                'salt'=>$salt,
                'key'=>$key,
                'sign'=>$sign
            ];
            $url="htt8瓶【l'o.k,ioljiu-hn 76p://api.fanyi.baidu.com/api/trans/vip/translate";
            $sign=$this->curlRequest($url,$data);
            $arr = json_decode($sign, true);
            $tmp = $arr['trans_result'][0]['dst'];
            return json_decode(json_encode(['status'=>100,'tmp'=>$tmp]),true);
        }
=======
        $res=$obj->connect('123.207.171.134','11211');
//        $server=$_SERVER['REMOTE_ADDR'];
//        $json=file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$server");
        //dump($json);exit;
        $city = '北京';//根据ip获取到的

        $tmpKey = md5($city);

        $pathFile = './' . $tmpKey;
        if (!$obj->get($tmpKey)) {
            //调用天气接口获取数据
            $json = $this->curlRequest('https://www.sojson.com/open/api/weather/json.shtml?city='. $city);
            $arr = json_decode($json, true);
            $tmp = $arr['data']['forecast'][0];

            //存储接口数据到缓存  数组转json字符串 存储到文件
            $obj->set($tmpKey, json_encode($tmp),0,10);
        } else {
            //从缓存中获取数据
            $data =$obj->get($tmpKey);
            $tmp = json_decode($data, true);
        }
    //编码
    //调用接口
        $data = '<br>'.$city . '天气：' . $tmp['high'] . '，' . $tmp['low'] . ',天气' . $tmp['type'];
        echo $data;
>>>>>>> 1d2c295046ecd4b56168ddeb684cb0714e1b9673
    }
//    public function weather()
//    {
//        $obj=new \Memcache();
//        $res=$obj->connect('139.199.115.147','11211');
////        $server=$_SERVER['REMOTE_ADDR'];
////        $json=file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$server");
//        //dump($json);exit;
//        $city = '北京';//根据ip获取到的
//
//        $tmpKey = md5($city);
//
//        $pathFile = './' . $tmpKey;
//        if (!$obj->get($tmpKey)) {
//            //调用天气接口获取数据
//            $json = $this->curlRequest('https://www.sojson.com/open/api/weather/json.shtml?city=' . $city);
//            $arr = json_decode($json, true);
//            print_r($arr);exit;
//            $tmp = $arr['data']['forecast'][0];
//
//            //存储接口数据到缓存  数组转json字符串 存储到文件
//            $obj->set($tmpKey, json_encode($tmp),0,10);
//        } else {
//            //从缓存中获取数据
//            $data =$obj->get($tmpKey);
//            $tmp = json_decode($data, true);
//        }
//    //编码
//    //调用接口
//        $data = '<br>'.$city . '天气：' . $tmp['high'] . '，' . $tmp['low'] . ',天气' . $tmp['type'];
//
//        echo $data;
//    }
    function curlRequest($url, $data = '')
    {
        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = false; //是否返回响应头信息
        $params[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36';
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
        $params[CURLOPT_TIMEOUT] = 30; //超时时间
        if (!empty($data)) {
            $params[CURLOPT_POST] = true;
            $params[CURLOPT_POSTFIELDS] = $data;
        }
        $params[CURLOPT_SSL_VERIFYPEER] = false;//请求https时设置,还有其他解决方案
        $params[CURLOPT_SSL_VERIFYHOST] = false;//请求https时,其他方案查看其他博文
        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }
    /**
     * 功能三
     */
    public function userList(){
        $user=DB::table('user')->join('comment','comment.user_id','=','user.id')->get()->groupBy('username');
        $user=json_decode(json_encode($user),true);
        return view('user',['user'=>$user]);
    }

    /**
     * 邮箱
     */
    public function email(){

        $obj = new \Memcache();
        $obj->connect('139.199.115.147','11211');
        $arr = $obj->get('email');
//        print_r($arr);exit;
        foreach($arr as $key=>$v)
        {
            $pos=strpos($arr[$key]['email'],"@");

            $str=substr($arr[$key]['email'],$pos+1);

            $data[]=$str;
        }
        $count=array_count_values($data);

// var_dump($count);die;

        foreach($count as $key=>$v)
        {
            echo $key."的邮箱有".$v."个"."<br>";

        }
        return view('email');
    }
}
