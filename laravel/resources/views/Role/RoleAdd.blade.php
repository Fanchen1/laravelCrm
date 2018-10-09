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
    <script src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/Admin/js/xcity.js"></script>
</head>

<body >

<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form" >
        <div class="layui-form-item">
            <label for="L_user_name" class="layui-form-label">
                <span class="x-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_user_name" name="power_name" placeholder="填写权限名称"
                       autocomplete="off" class="layui-input">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-inline">
                <input type="checkbox"  name="off" lay-skin="switch" value="1" lay-text="开启|关闭" checked >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">权限节点：</label>
            <div class="layui-input-block">
              @foreach($power as $v)
                    <fieldset class="layui-form-field" style="width: 500px;">
                        <legend>
                            <input type="checkbox" name="node[]" lay-filter="one" value="{{$v['power_id']}}"
                                       lay-skin="primary" title="{{$v['power_name']}}">
                        </legend>
                        <div class="layui-field-box" style="margin-left: 50px;">
                            @foreach($v['son'] as $vv)
                                <input type="checkbox" name="node[]" lay-filter="two"
                                         lay-skin="primary" title="{{$vv['power_name']}}" value="{{$vv['power_id']}}">
                            @endforeach
                        </div>
                    </fieldset>
               @endforeach
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn layui-btn-radius layui-btn-normal" type="button" name="add">
                <i class="layui-icon">&#xe654;</i>
                增加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['upload','form'], function() {
        var $ = layui.jquery, upload = layui.upload;
        var form = layui.form;
        form.on('checkbox(one)', function (data) {
            if ($(this).parents('fieldset').find('input').eq(0).prop('checked') == true) {
                $(this).parents('fieldset').find('input').prop('checked', true);
            } else {
                $(this).parents('fieldset').find('input').prop('checked', false);
            }
            form.render();
        });
        //        checkbox点击事件 -----       二级菜单点击事件
        form.on('checkbox(two)', function (data) {
            var mark = 0;
            $(this).parents('fieldset').find('input:gt(0)').each(function () {
                if ($(this).prop('checked') == true) {
                    mark = 1;
                }
            });
            if (mark == 1) {
                $(this).parents('fieldset').find('input').eq(0).prop('checked', true);
            } else {
                $(this).parents('fieldset').find('input').eq(0).prop('checked', false);
            }
            form.render();
        });


    });










    $('[name=add]').on('click',function(){
        var power_name = $('[name=power_name]').val();//权限名称
        var power_url = $('[name=power_url]').val();//访问路径
        var power_id = $('[name=power_id]').val();//父级权限
        var off = $('[name=off]').next().hasClass('layui-form-onswitch');
        var offs = 2;
        if(off==true){
            offs = 1;
        }
        if(power_name == ''){
            layer.msg('权限名称不能为空',{icon:2});
            return false;
        }
        if(power_url == ''){
            layer.msg('访问路径不能为空',{icon:2});
            return false;
        }
        $.ajax({
            url: '/index.php/PowerAddDo',
            type: 'post',
            data: 'power_name=' + power_name +'&power_url='+power_url+'&power_id='+power_id+'&off='+offs+'&_token='+'{{csrf_token()}}',
            dataType: 'json',
            async: false,
            success: function (json_info) {
                if (json_info.status == 1000) {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    window.parent.location.reload();
                    //关闭当前frame
                    parent.layer.close(index);

                    return false;
                } else {
                    layer.msg(json_info.msg, {icon: 0});
                    return false;
                }
            }
        });
        return false;
    });
</script>

</body >
</html>