<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    {{--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />--}}
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">
    <script type="text/javascript" src="/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>-->
    <!--<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form">
        <div  style="margin-left: 35px">
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">翻译前：</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" class="layui-textarea" name="qian"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">翻译后：</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea"  name="hou"></textarea>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" type="button" id="translate" lay-filter="add" lay-submit="">
                翻译
            </button>
        </div>
    </form>
</div>
<script>
    $('#translate').on('click',function(){
        var qian=$('[name=qian]').val();
        $.ajax({
            url:'/translateApi',
            data:'qian='+qian,
            type:'get',
            dataType:'json',
            async:false,
            success:function(json_info){
                if(json_info.status==100){
                    $('[name=hou]').html(json_info.tmp)
                }
            }
        })
    })


</script>