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
                <span class="x-red">*</span>合同编号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="pact_no"  name="pact_no" disabled lay-verify="required" autocomplete="off"  value="{{$pact_no}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>合同分类
            </label>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <select name="modules" lay-verify="required" lay-search="">
                        <option value="">直接选择或搜索选择</option>
                        @foreach($pacttypeList as $v)
                        <option value="{{$v->pacttype_id}}">{{$v->pacttype_name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="layui-btn" onclick="x_admin_show('添加用户','/pact_add',500,200)">增加</button>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单编号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="order_id" name="order_id"
                       class="layui-input" value="{{$order_no}}">
            </div>
            <button class="layui-btn" onclick="x_admin_show('订单列表','/orderList',1000,400)">...</button>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                <span class="x-red">*</span>开始时间
            </label>
            <div class="layui-input-inline">
                <input type="datetime-local" id="pact_stime" name="pact_stime"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone0" class="layui-form-label">
                <span class="x-red">*</span>到期时间
            </label>
            <div class="layui-input-inline">
                <input type="datetime-local" id="pact_etime" name="pact_etime" required=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>已收款
            </label>
            <div class="layui-input-inline">
                <input type="text" id="pact_payment" name="pact_payment" value="0" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>元
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>总金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="pact_totalmoney" name="pact_totalmoney" value="0" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>元
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否提供发票</label>
            <div class="layui-input-inline">
                <select name="is_invoice"  lay-filter="aihao">
                    <option value="0">请选择</option>
                    <option value="1">是</option>
                    <option value="2">否</option>

                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否含税</label>
            <div class="layui-input-inline">
                <select name="is_tax"  lay-filter="aihao">
                    <option value="0">请选择</option>
                    <option value="1">是</option>
                    <option value="2">否</option>
                </select>
            </div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span> 详情备注
            </label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="pact_contents" name="pact_contents" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" id="but" type="button" lay-filter="add" lay-submit="">
                增加
            </button>
        </div>
    </form>
</div>
</body>
</html>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $('#but').on('click',function(){
        var pact_no=$('#pact_no').val();
        var is_tax=$('[name=is_tax]').val();
        var is_invoice=$('[name=is_invoice]').val();
        var order_id=$('[name=order_id]').val();
        if(order_id==''){
            layer.msg('订单编号必填',{icon:5})
        }
        var pact_stime=$('#pact_stime').val();
        var pact_etime=$('#pact_etime').val();
        if(pact_stime>pact_etime){
            layer.msg('开始时间不能大于到期时间',{icon:5})
        }
        var pact_payment=$('#pact_payment').val();
        if(pact_payment==''){
            layer.msg('已收款必填',{icon:5})
        }
        if(pact_payment<=0){
            layer.msg('已收款必须大于0元',{icon:5})
        }
        var pact_totalmoney=$('#pact_totalmoney').val();
        if(pact_totalmoney==''){
            layer.msg('总金额必填',{icon:5})
        }
        var modules=$('[name=modules]').val();
        if(pact_totalmoney<=0){
            layer.msg('总金额必须大于0元',{icon:5})
        }
//        if(pact_totalmoney<=pact_payment){
//            layer.msg('总金额必须大于已收款金额',{icon:5})
//        }
        var pact_contents=$('#pact_contents').val();
        if(pact_contents==''){
            layer.msg('详情备注必填');
        }
        $.ajax({
            url:'/pactAddAll',
            data:'pact_no='+pact_no+'&order_id='+order_id+'&is_tax='+is_tax+'&is_invoice='+is_invoice+'&pact_stime='+pact_stime+'&pact_etime='+pact_etime+'&pact_payment='+pact_payment+'&pact_totalmoney='+pact_totalmoney+'&pact_contents='+pact_contents+'&modules='+modules,
            type:'post',
            dataType:'json',
            async:false,
            success:function(json_info){
                if(json_info.status==100){
                   layer.msg(json_info.msg,{icon:1},function(){
                      history.go(0)
                   })
                }else{
                    layer.msg(json_info.msg,{icon:5})
                }
            }
        })
    })
</script>