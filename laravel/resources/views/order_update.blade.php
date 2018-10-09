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
    <script type="text/javascript" src="/Admin/js/jquery-3.2.1.min.js"></script>    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
</head>

<body>
<div class="x-body">
    <form class="layui-form" id = "form"   >
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" name="order_id" value ="{{$find['order_id']}}">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_no" value="{{$find['order_no']}}" name="order_no" disabled lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>预付款
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_imprest" value="{{$find['order_imprest']}}" name="order_imprest" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_price"  value="{{$find['order_price']}}" name="order_price" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                详情备注
            </label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="desc" name="order_contents" class="layui-textarea">{{$find['order_contents']}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" type="button" id="butto" lay-filter="add" lay-submit="">
                修改
            </button>
        </div>
    </form>
</div>
</body>
</html>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('#butto').on('click',function(){
        var id=$('[name=order_id]').val();
        var order_imprest=$('[name=order_imprest]').val();
        var order_price=$('[name=order_price]').val();
        var order_contents=$('[name=order_contents]').val();
        $.ajax({
            url:'/index.php/updateDo',
            data:'id='+id+'&order_imprest='+order_imprest+'&order_price='+order_price+'&order_contents='+order_contents,
            type:'post',
            dataType:'json',
            async:false,
            success:function(json_info){
                if(json_info.status==100){
                    layer.msg(json_info.msg,{icon:1},function(){
                       history.go(0)
                    });
                }else {
                    layer.msg(json_info.msg,{icon:2})
                }
            }
        })
    })
</script>