<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<<<<<<< HEAD
    <link rel="stylesheet" href="Admin/css/font.css">
    <link rel="stylesheet" href="Admin/css/xadmin.css">
    <script src="/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="Admin/js/xadmin.js"></script>

=======
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
>>>>>>> 1d2c295046ecd4b56168ddeb684cb0714e1b9673
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>

    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <script type="text/javascript" src="layer/layer.js"></script>
    <script type="text/javascript" src="layer/mobile/need/layer.css"></script>
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
        <meta name="csrf-token" content="{{csrf_token() }}">
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
</body>
</html>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('#orderAdd').ready(function(){
        $.ajax({
            url:'/index.php/order',
            type:'post',
            dataType:'json',
            success:function(json_info){
                console.log(json_info)
        }
        })
    $('.layui-btn').on('click',function(){
        $.ajax({
            url:'/index.php/order_add',
            data:$('#form').serialize(),
            type:'post',
            dataType:'json',
            async:false,
            success:function(json_info){
                if(json_info.status==100){
                    layer.msg(json_info.msg,{icon:1},function(){
                        location.href='/index.php/order_list';
                    })
                }else{
                    layer.msg(json_info.msg,{icon:2})
                }
            }
        })
    })
    })
</script>