<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layui-anim layui-anim-up">
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">客户管理</a>
        <a>
            <cite>客户列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn"  type="button" name="sou"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加角色','/index.php/RoleAdd',1000,600)"><i class="layui-icon"></i>角色添加</button>
        {{--<span class="x-right" style="line-height:40px">共有数据：88 条</span>--}}
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary" ><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>权限名称</th>
            <th>访问路径</th>
            <th>是否启用</th>
            <th>父级id</th>
            <th>等级</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody name="shu">
        {{--@foreach($power as $v)--}}
            {{--<tr>--}}
                {{--<td>--}}
                    {{--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary" ><i class="layui-icon">&#xe605;</i></div>--}}
                {{--</td>--}}
                {{--<td>{{$v['power_id']}}</td>--}}
                {{--<td>{{$v['power_name']}}</td>--}}
                {{--<td>{{$v['power_url']}}</td>--}}
                {{--<td>{{$v['power_status']}}</td>--}}
                {{--<td>{{$v['parent_id']}}</td>--}}
                {{--<td>{{$v['power_level']}}</td>--}}
                {{--<td>{{$v['power_ctime']}}</td>--}}
                {{--<td class="td-manage">--}}
                    {{--<a title="编辑"  onclick="x_admin_show('编辑','/index.php/userUpdate?id={{$v['power_id']}}',1000,600)" href="javascript:;">--}}
                        {{--<i class="layui-icon">&#xe642;</i>--}}
                    {{--</a>--}}
                    {{--<a title="删除" onclick="member_del(this,{{$v['power_id']}})" href="javascript:;">--}}
                        {{--<i class="layui-icon">&#xe640;</i>--}}
                    {{--</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        </tbody>
    </table>
    <div class="page">
        <div>

        </div>
    </div>

</div>
<script>

    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });


    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                url: '/index.php/userDel',
                type: 'post',
                data: 'id='+id+'&_token=' + '{{csrf_token()}}',
                dataType: 'json',
                async: false,
                success: function (json_info) {
                    if (json_info.status == 1000) {
                        //发异步删除数据
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                        return false;
                    } else {
                        layer.msg(json_info.msg, {icon: 0});
                        return false;
                    }
                }
            });
        });
    }

    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            $.ajax({
                url: '/index.php/userDelAll',
                type: 'post',
                data: 'id='+data+'&_token=' + '{{csrf_token()}}',
                dataType: 'json',
                async: false,
                success: function (json_info) {
                    if (json_info.status == 1000) {
                        layer.msg('删除成功', {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                        return false;
                    } else {
                        layer.msg(json_info.msg, {icon: 0});
                        return false;
                    }
                }
            });
        });
    }

    /* 客户搜索*/
    $('[name=sou]').on('click',function(){
        var start = $('[name=start]').val();
        var end = $('[name=end]').val();
        var username = $('[name=username]').val();
        $.ajax({
            url: '/index.php/userList',
            type: 'post',
            data: 'start='+start+'&end='+end+'&username='+username+'&_token=' + '{{csrf_token()}}',
            dataType: 'json',
            async: false,
            success: function (json_info) {
                if (json_info.status == 1000) {
                    $('#shu').html(json_info);
                    return false;
                }
            }
        });
    });


</script>


<script>
    var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>


</body>

</html>


