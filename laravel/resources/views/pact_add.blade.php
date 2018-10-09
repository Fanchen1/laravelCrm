<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="Admin/css/font.css">
    <link rel="stylesheet" href="Admin/css/xadmin.css">
    <script src="/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="Admin/js/xadmin.js"></script>

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
                <span class="x-red">*</span>参数
            </label>
            <div class="layui-input-inline">
                <input type="text" id="pacttype_name"  name="pacttype_name"  lay-verify="required" autocomplete="off"   class="layui-input">
            </div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
//    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('.layui-btn').on('click',function(){
        var pacttype_name=$('#pacttype_name').val();

        $.ajax({
            url:'/pact_add_name',
            data:'pacttype_name='+pacttype_name,
            type:'post',
            dataType:'json',
            async:false,
            success:function(json_info){
                if(json_info.status==100){
                    layer.msg('添加成功',{icon:1},function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                        window.parent.location.reload();
                    })
                }else{
                    layer.msg(json_info.msg,{icon:2})
                }
            }
        })
    })
</script>