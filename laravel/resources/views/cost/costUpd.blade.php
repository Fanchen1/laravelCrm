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
    <script type="text/javascript" src="/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form">
        <input type="hidden" value="{{$cost_data->cost_id}}" name="id">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>费用类型
            </label>
            <div class="layui-input-inline">
                <select lay-filter="mem" id="shipping" name="cost_type_id" class="valid" lay-verify="required">
                    @foreach($costtype_data as $value)
                        @if($value['cost_type_id'] == $cost_data->cost_type_id)
                            <option value="{{$value['cost_type_id']}}" selected>{{$value['cost_type_name']}}</option>
                        @else
                            <option value="{{$value['cost_type_id']}}">{{$value['cost_type_name']}}</option>
                        @endif
                    @endforeach

                {{--@foreach($costtype_data as $value)--}}
                    {{--@if(!empty($costtype['type']))--}}
                        {{--@if($costtype['type'] == $value['cost_type_name'])--}}
                            {{--<option value="{{$value['cost_type_id']}}" selected>{{$value['cost_type_name']}}</option>--}}
                        {{--@else--}}
                            {{--<option value="{{$value['cost_type_id']}}">{{$value['cost_type_name']}}</option>--}}
                        {{--@endif--}}
                    {{--@else--}}
                        {{--<option value="{{$value['cost_type_id']}}">{{$value['cost_type_name']}}</option>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
                </select>
            </div>
            {{--<button type='button' class="layui-btn layui-btn-normal" onclick="x_admin_show('添加费用类型','costTypeAdd',300,200)" ><i class="layui-icon"></i></button>--}}
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>客户名称
            </label>
            <div class="layui-input-inline">
                <select lay-filter="mem" id="shipping" name="username" class="valid" lay-verify="required">
                    @foreach($user_data as $value)
                        @if($value['user_id'] == $cost_data->user_id)
                            <option value="{{$value['user_id']}}" selected>{{$value['user_name']}}</option>
                        @else
                            <option value="{{$value['user_id']}}">{{$value['user_name']}}</option>
                        @endif
                    @endforeach
                </select>            </div>
            {{--<button class="layui-btn layui-btn-normal"><i class="layui-icon"></i></button>--}}
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>收支日期
            </label>
            <div class="layui-input-inline">
                <input value="{{date('Y-m-d H:i:s',$cost_data->cost_time)}}" lay-filter="mem" type="text" class="layui-input" id="test5" placeholder="yyyy-MM-dd HH:mm:ss" name="cost_time" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">金额</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input value='{{$cost_data->cost_money}}' type="text" name="price" placeholder="￥" autocomplete="off" class="layui-input" lay-verify="required">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">收支类型</label>
            <div class="layui-input-block">
                @if($cost_data->cost_type == '收入')
                    <input type="radio" name="cost_type" value="收入" title="收入" checked="">
                    <input type="radio" name="cost_type" value="支出" title="支出">
                @else
                    <input type="radio" name="cost_type" value="收入" title="收入">
                    <input type="radio" name="cost_type" value="支出" title="支出" checked="">
                @endif
            </div>
        </div>

    <div class="layui-form-item layui-form-text">
    <label for="desc" class="layui-form-label">
        详情备注
    </label>
    <div class="layui-input-block">
        <textarea lay-filter="mem" lay-change="" placeholder="请输入内容" id="desc" name="tailorder_contents" class="layui-textarea" lay-verify="required">{{$cost_data->cost_contents}}</textarea>
    </div>
</div>
    <div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn" lay-filter="add" lay-submit="">
        修改
    </button>
</div>
</form>
</div>
<script>
    layui.use(['form','layer','laydate'], function(){
        var laydate = layui.laydate;
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //日期时间选择器
        laydate.render({
            elem: '#test5'
            ,type: 'datetime'
        });

        //监听提交
        form.on('submit(add)', function(data){

            $.ajax({
                url:'costUpdDo',
                data:'cost_type_id='+data.field.cost_type_id+
                     '&price='+data.field.price+
                     '&username='+data.field.username+
                     '&cost_time='+data.field.cost_time+
                     '&contents='+data.field.tailorder_contents+
                     '&type='+data.field.cost_type+
                     '&id='+data.field.id+
                     '&_token='+'{{csrf_token()}}',
                dataType:'json',
                type:'post',
                success:function(json_info){
                    if(json_info.status==1000){
                        layer.msg("修改成功",{time:2000},function () {
                            window.parent.location.reload();
                        });
                    }else{
                        layer.msg(json_info.msg);
                    }
                }

            })
            return false;
        });
//        form.on('select(mem)',function(data){
//            console.log(data);
//        })

    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>

</html>