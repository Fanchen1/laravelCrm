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
        <a href="">售后管理</a>
        <a>
            <cite>售后列表</cite></a>
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
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加售后','/index.php/aftersaleAdd',1000,600)"><i class="layui-icon"></i>添加</button>
        {{--<span class="x-right" style="line-height:40px">共有数据：88 条</span>--}}
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>反馈主题</th>
            <th>相关产品</th>
            <th>联系人</th>
            <th>反馈分类</th>
            <th>反馈日期</th>
            <th>详情备注</th>
            <th>是否解决</th>
            <th>结束日期</th>
            <th>处理结果</th>
            <th>添加时间</th>
            <th>修改时间</th>
            <th>处理</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($aftersale as $v)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td> {{$v->aftersale_id}}</td>
                <td>{{$v->aftersale_issue}}</td>
                <td>{{$v->product_name}}</td>
                <td>{{$v->user_name}}</td>
                <td>{{$v->aftersale_classify}}</td>
                <td>{{$v->aftersale_time}}</td>
                <td>{{$v->aftersale_contents}}</td>
                <td>
                    @if($v->is_solve == '待解决')
                        <span style="color: #ff3718">{{$v->is_solve}}</span>
                    @else
                        <span style="color: #0000F0">{{$v->is_solve}}</span>
                    @endif
                </td>
                <td>
                    @if($v->result_time == '还未处理哦！')
                        <span style="color: #ff188e;">{{$v->result_time}}</span>
                    @else
                        <span style="color: #0000F0;">{{$v->result_time}}</span>
                    @endif
                </td>
                <td>
                    @if($v->result == '还未处理哦！')
                        <span style="color: #ff188e;">{{$v->result}}</span>
                    @else
                        <span style="color: #0000F0;">{{$v->result}}</span>
                    @endif
                </td>
                <td>{{$v->aftersale_ctime}}</td>
                <td>
                    @if($v->aftersale_utime == '还未修改哦！')
                        <span style="color: #9561e2;">{{$v->aftersale_utime}}</span>
                    @else
                        <span style="color: #0000F0;">{{$v->aftersale_utime}}</span>
                    @endif
                </td>
                <td>
                    <button class="layui-btn layui-btn-radius layui-btn-warm" type="button" onclick="x_admin_show('处理','/index.php/dispose?id={{$v->aftersale_id}}',1000,600)"> <i class="layui-icon">&#xe654;</i>处理</button>
                </td>
                <td class="td-manage">
                    <a title="编辑"  onclick="x_admin_show('编辑','/index.php/aftersaleUpdate?id={{$v->aftersale_id}}',1000,600)" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,{{$v->aftersale_id}})" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        <div>
            {{ $aftersale->links() }}
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
                url: '/index.php/aftersaleDel',
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
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
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


