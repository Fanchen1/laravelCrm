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
        <a>
            <cite>订单列表,单击选中</cite>
        </a>
</div>
<div class="x-body">


    <table class="layui-table">
        <thead>
        <tr>
            <th>订单id</th>
            <th>联系人</th>
            <th>下单日期</th>
            <th>交单日期</th>
            <th>预付款</th>
            <th>订单金额</th>
            <th>订单状态</th>
            <th>业务员</th>
            <th>录入时间</th>
        </tr>
        </thead>
        <div class="page">
            {{--<div class="container">--}}
            <meta name="csrf-token" content="{{ csrf_token() }}">
                <tbody>
                @foreach ($page as $user)
                    <tr class="tr">
                        <td id="id">{{$user->order_id}}</td>
                        <td>{{$user->user_id}}</td>
                        <td>{{date('Y-m-d H:i:s',$user->order_stime)}}</td>
                        <td>{{date('Y-m-d H:i:s',$user->order_etime)}}</td>
                        <td>{{$user->order_imprest}}</td>
                        <td>{{$user->order_price}}</td>
                        @if($user->order_status==1)
                            <td>已支付</td>
                        @else
                            <td>未支付</td>
                        @endif
                        <td>{{$user->admin_id}}</td>
                        <td>{{date('Y-m-d H:i:s',$user->order_ctime)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </div>

        {{--</div>--}}
    </table>
</div>
<script>
    $.ajaxSetup({headers:
    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('.tr').on('click',function(){
        var th=$(this).find('td').html();
        $.ajax({
            url:'/pactFind',
            data:'id='+th,
            type:'post',
            dataType:'json',
            async:false,
            success:function(json_info){
                var order=json_info.order;
                var index = parent.layer.getFrameIndex(window.name);
                parent.$('#order_id').val(order);
                parent.layer.close(index);
                location.href='/pactAdd?order_no='+order;
            }
        })
    })
</script>
</body>

