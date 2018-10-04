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
    <script type="text/javascript" src="/Admin/js/xcity.js"></script>
</head>
<body>




<div class="layui-form-item">
    <label for="L_email" class="layui-form-label">
        <span class="x-red">*</span>客户来源
    </label>
    <div class="layui-input-inline">
        <input type="text" id="source" name="email" required="" lay-verify="email"
               autocomplete="off" class="layui-input" style="width: 200px;" >
    </div>
</div>




<div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn layui-btn-radius layui-btn-normal" id="submit">
        <i class="layui-icon">&#xe654;</i>
        保存
    </button>
</div>



</body>

</html>

<script>
    $('#submit').on('click',function(){
        var source= $('#source').val();
        if(source == ''){
            layer.msg('客户来源不能为空',{icon:0});
            return false;
        }

        $.ajax({
            url:'/index.php/userSourceDo',
            type:'post',
            data:'source='+source+'&_token='+'{{csrf_token()}}',
            dataType:'json',
            async:false,
            success:function( json_info ){
                if(json_info.status == 1000){
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                    return false;
                }else{
                    layer.msg(json_info.msg,{icon:0});
                    return false;
                }
            },

        });


        return false;
    });
</script>