<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">
    <script src="/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            {{--<input class="layui-input" placeholder="开始日" name="start" id="start">--}}
            {{--<input class="layui-input" placeholder="截止日" name="end" id="end">--}}
            <div class="layui-input-inline">
                <select name="contrller">
                    <option>支付状态</option>
                    <option value="1">已支付</option>
                    <option value="2">未支付</option>
                </select>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="text" name="username"  placeholder="请输入订单号" autocomplete="off" class="layui-input">
            <button class="layui-btn" id="search"  lay-submit="" type="button" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','/order',800,500)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}}条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>订单id</th>
            <th>订单编号</th>
            <th>联系人</th>
            <th>下单日期</th>
            <th>交单日期</th>
            <th>预付款</th>
            <th>订单金额</th>
            <th>订单状态</th>
            <th>订单备注</th>
            <th>业务员</th>
            <th>录入时间</th>
            <th>修改时间</th>
            <th >操作</th>
        </tr>
        </thead>
        <div class="page">
            <div class="container">
                <tbody>
                @foreach ($page as $user)

                    <tr>
                        <td>
                            <div class="layui-unselect layui-form-checkbox check" idd = "{{$user->order_id}}" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                        </td>
                        <td>{{$user->order_id}}</td>
                        <td>{{$user->order_no}}</td>
                        <td>{{$user->user_id}}</td>
                        <td>{{$user->order_stime}}</td>
                        <td>{{$user->order_etime}}</td>
                        <td>{{$user->order_imprest}}</td>
                        <td>{{$user->order_price}}</td>
                        @if($user->order_status==1)
                            <td>已支付</td>
                        @else
                            <td>未支付</td>
                        @endif

                        <td>{{$user->order_contents}}</td>
                        <td>{{$user->admin_id}}</td>
                        <td>{{$user->order_ctime}}</td>
                        <td>{{$user->order_utime}}</td>
                        <td class="td-manage">
                            <a title="查看"  onclick="x_admin_show('编辑','/order_update?id={{$user->order_id}}')" href="javascript:;">
                                <i class="layui-icon">&#xe63c;</i>
                            </a>
                            <a title="删除" onclick="member_del(this,{{$user->order_id}})" href="javascript:;">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </div>

        </div>
    </table>
</div>
{{ $page->links() }}
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('#search').on('click',function(){
        var contrller=$('[name=contrller]').val();
        var username=$('[name=username]').val();
        $.ajax({
            url:'index.php/order_list',
            data:'contrller='+contrller+'&username='+username,
            type:'post',
            dataType:'html',
            async:false,
            success:function(json_info){
                document.body.innerHTML=json_info;
                if(json_info.status==100){

                }else{
                    layer.msg(json_info.msg)
                }
            }
        })
    })

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                url:'/index.php/orderDel',
                data:'id='+id,
                type:'post',
                dataType:'json',
                asyun:false,
                success:function(json_info){
                    if(json_info.status==100){
                        layer.msg(json_info.msg,{icon:1},function(){
                            history.go(0)
                        })
                    }else{
                        layer.msg(json_info.msg,{icon:2})
                    }
                }
            })
//            //发异步删除数据
//            $(obj).parents("tr").remove();
        });
    }


    //layui-unselect layui-form-checkbox
    //layui-unselect layui-form-checkbox layui-form-checked
    var str = '';
    function delAll () {
        str = ''
        $('.check').each(function(){
            if($(this).hasClass('layui-form-checked')==true){
                str += $(this).attr('idd')+',';
            }
        });
        if(str==''){
            layer.msg('请选择要删除的id',{icon:2});
            return false;
        }
//        var data = tableCheck.getData();
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                    url:'index.php/delAll',
                    data:'id='+str,
                    type:'post',
                    dataType:'json',
                    async:false,
                    success:function(json_info){
                        if(json_info.status==100){
                            layer.msg(json_info.msg,{icon:1},function(){
                                history.go(0)
                            })
                        }else{
                            layer.msg(json_info.msg,{icon:2})
                        }
                    }
                })
        });

//                        $.ajax({
//                    url:'index.php/delAll',
//                    data:'id='+str,
//                    type:'post',
//                    dataType:'json',
//                    async:false,
//                    success:function(json_info){
//                        if(json_info.status==100){
//                            layer.msg(json_info.msg,{icon:1},function(){
//                              //  history.go(0)
//                            })
//                        }else{
//                            layer.msg(json_info.msg,{icon:2})
//                        }
//                    }
//                })

    }
//        var data = tableCheck.getData();
//        layer.confirm('确认要删除吗？'+data,function(index){
//            //捉到所有被选中的，发异步进行删除
//            layer.msg('删除成功', {icon: 1});
//           $(".layui-form-checked").not('.header').parents('tr').remove();
//        });

</script>
{{--<script>var _hmt = _hmt || []; (function() {--}}
        {{--var hm = document.createElement("script");--}}
        {{--hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";--}}
        {{--var s = document.getElementsByTagName("script")[0];--}}
        {{--s.parentNode.insertBefore(hm, s);--}}
    {{--})();</script>--}}
</body>

