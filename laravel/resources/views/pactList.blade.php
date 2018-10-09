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
    <script type="text/javascript" src="/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>

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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <table class="layui-table">
        <thead>
        <tr>
            <th>编号</th>
            <th>合同编号</th>
            <th>起始日期</th>
            <th>到期日期</th>
            <th>合同分类</th>
            <th>合同状态</th>
            <th>审核</th>
            <th>管理</th>
        </tr>
        </thead>


                <tbody>
                @foreach ($pact as $v)

                    <tr class="tr">
                        <td>{{$v->pact}}</td>
                        <td>{{$v->pact_no}}</td>
                        <td>{{date('Y-m-d H:i:s',$v->pact_stime)}}</td>
                        <td>{{date('Y-m-d H:i:s'),$v->pact_etime}}</td>
                        <td>{{$v->pacttype_name}}</td>
                        @if($v->pact_status==1)
                        <td>待审核</td>
                        @elseif($v->pact_status==2)
                        <td>已审核</td>
                        @else
                        <td>已删除</td>
                        @endif
                        @if($v->pact_status==1)
                            <td><button class="layui-btn layui-btn-primary layui-btn-xs" id="shen">审核</button></td>
                        @elseif($v->pact_status==2)
                            <td><button class="layui-btn layui-btn-primary layui-btn-xs">删除</button></td>
                        @else
                            <td><button class="layui-btn layui-btn-disabled layui-btn-xs">已删除</button></td>
                        @endif
                        <td class="td-manage">
                            <a title="查看"  onclick="x_admin_show('编辑','pact_update?id={{$v->pact}}')" href="javascript:;">
                                <i class="layui-icon">&#xe63c;</i>
                            </a>
                            <a title="删除" onclick="member_del(this,{{$v->pact}})" href="javascript:;">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
    </table>
</div>
<div class="page">
    {{ $pact->links() }}
</div>

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                url:'pactDel',
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
        });
    }
    //审核
    $('#shen').on('click',function(){
        var id=$('.tr').find('td').html();
        alert(id);
      //  location.href='audit';
    })


</script>
</body>



