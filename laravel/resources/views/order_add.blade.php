<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <script src="{{asset('/jquery/jquery-3.2.1.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/layer/mobile/need/layer.css')}}"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" id = "form"   >
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_no" value="{{$order_no}}" name="order_no" disabled lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>下单日期
            </label>
            <div class="layui-input-inline">
                <input type="datetime-local" id="order_stime" name="order_stime" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone0" class="layui-form-label">
                <span class="x-red">*</span>交单日期
            </label>
            <div class="layui-input-inline">
                <input type="datetime-local" id="order_etime" name="order_etime" required="" lay-verify="p3hone"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>预付款
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_imprest" name="order_imprest" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_price" name="order_price" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        {{--<div class="layui-form-item">--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>订单状态--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="order_status" name="order_status" required="" lay-verify="required"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item">--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>详情备注--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="order_contents" name="order_contents" required="" lay-verify="required" autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item">--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>业务员--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="admin_id" name="admin_id" required="" lay-verify="required"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item">--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>支付方式--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<select name="contrller">--}}
                    {{--<option>支付方式</option>--}}
                    {{--<option>支付宝</option>--}}
                    {{--<option>微信</option>--}}
                    {{--<option>货到付款</option>--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="layui-form-item">--}}
            {{--<label for="L_email" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>发票抬头--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="L_email" name="email" required="" lay-verify="email"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
            {{--<div class="layui-form-mid layui-word-aux">--}}
                {{--<span class="x-red">*</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item layui-form-text">--}}
            {{--<label for="desc" class="layui-form-label">--}}
                {{--商品增加--}}
            {{--</label>--}}
            {{--<div class="layui-input-block">--}}
                {{--<table class="layui-table">--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<td>haier海尔 BC-93TMPF 93升单门冰箱</div></td>--}}
            {{--<td>0.01</div></td>--}}
        {{--<td>984</div></td>--}}
{{--<td>1</td>--}}
{{--<td>删除</td>--}}
{{--</tr>--}}
{{--<tr>--}}
    {{--<td>haier海尔 BC-93TMPF 93升单门冰箱</div></td>--}}
    {{--<td>0.01</div></td>--}}
    {{--<td>984</div></td>--}}
    {{--<td>1</td>--}}
    {{--<td>删除</td>--}}
{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}
{{--</div>--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
<div class="layui-form-item layui-form-text">
    <label for="desc" class="layui-form-label">
        详情备注
    </label>
    <div class="layui-input-block">
        <textarea placeholder="请输入内容" id="desc" name="order_contents" class="layui-textarea"></textarea>
    </div>
</div>
<div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn" type="button" lay-filter="add" lay-submit="">
        增加
    </button>
</div>
</form>
</div>
{{--<script>--}}
    {{--layui.use(['form','layer'], function(){--}}
        {{--$ = layui.jquery;--}}
        {{--var form = layui.form--}}
                {{--,layer = layui.layer;--}}

        {{--//自定义验证规则--}}
        {{--form.verify({--}}
            {{--nikename: function(value){--}}
                {{--if(value.length < 5){--}}
                    {{--return '昵称至少得5个字符啊';--}}
                {{--}--}}
            {{--}--}}
            {{--,pass: [/(.+){6,12}$/, '密码必须6到12位']--}}
            {{--,repass: function(value){--}}
                {{--if($('#L_pass').val()!=$('#L_repass').val()){--}}
                    {{--return '两次密码不一致';--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}

        {{--//监听提交--}}
        {{--form.on('submit(add)', function(data){--}}
            {{--console.log(data);--}}
            {{--//发异步，把数据提交给php--}}
            {{--layer.alert("增加成功", {icon: 6},function () {--}}
                {{--// 获得frame索引--}}
                {{--var index = parent.layer.getFrameIndex(window.name);--}}
                {{--//关闭当前frame--}}
                {{--parent.layer.close(index);--}}
            {{--});--}}
            {{--return false;--}}
        {{--});--}}


    {{--});--}}
{{--</script>--}}
{{--<script>var _hmt = _hmt || []; (function() {--}}
        {{--var hm = document.createElement("script");--}}
        {{--hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";--}}
        {{--var s = document.getElementsByTagName("script")[0];--}}
        {{--s.parentNode.insertBefore(hm, s);--}}
    {{--})();</script>--}}
</body>

</html>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('#orderAdd').ready(function(){
        $.ajax({
            url:'/order',
            type:'post',
            dataType:'json',
            success:function(json_info){
                console.log(json_info)
        }
        })
    $('.layui-btn').on('click',function(){
        $.ajax({
            url:'order_add',
            data:$('#form').serialize(),
            type:'post',
            dataType:'json',
            async:false,
            success:function(json_info){
                if(json_info.status==100){
                    layer.msg(json_info.msg,{icon:1},function(){
                        location.href='/order_list';
                    })
                }else{
                    layer.msg(json_info.msg,{icon:2})
                }
            }
        })
    })
    })
</script>