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
        <input value="{{$tailorder_data['tailorder_id']}}" lay-filter="mem" type="hidden" class="layui-input" name="id" lay-verify="required">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>跟单类型
            </label>
            <div class="layui-input-inline">
                <select lay-filter="mem" id="shipping" name="tailorder_type" class="valid" lay-verify="required">

                    @foreach($type_data as $value)
                        @if($value['tailorder_type_id'] == $tailorder_data['tailorder_type_id'])
                            <option value="{{$value['tailorder_type_id']}}" selected>{{$value['tailorder_type_name']}}</option>
                        @else
                            <option value="{{$value['tailorder_type_id']}}" selected>{{$value['tailorder_type_name']}}</option>
                        @endif
                    @endforeach

                {{--@foreach($type_data as $value)--}}
                    {{--@if(!empty($tailorder['type']))--}}
                        {{--@if($tailorder['type']==$value['tailorder_type_name'])--}}
                            {{--<option value="{{$value['tailorder_type_id']}}" selected>{{$value['tailorder_type_name']}}</option>--}}
                        {{--@else--}}
                            {{--<option value="{{$value['tailorder_type_id']}}">{{$value['tailorder_type_name']}}</option>--}}
                        {{--@endif--}}
                    {{--@else--}}
                        {{--<option value="{{$value['tailorder_type_id']}}">{{$value['tailorder_type_name']}}</option>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
                </select>
            </div>
            {{--<button type='button' class="layui-btn layui-btn-normal" onclick="x_admin_show('添加跟单类型','tailorderTypeAdd',300,200)" ><i class="layui-icon"></i></button>--}}
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>跟单进度
            </label>
            <div class="layui-input-inline">
                <select lay-filter="mem" id="shipping" name="tailorder_plan" class="valid" lay-verify="required">
                    @foreach($plan_data as $value)
                        @if($value['tailorder_plan_id'] == $tailorder_data['tailorder_plan_id'])
                            <option value="{{$value['tailorder_plan_id']}}" selected>{{$value['tailorder_plan_name']}}</option>
                        @else
                            <option value="{{$value['tailorder_plan_id']}}" selected>{{$value['tailorder_plan_name']}}</option>
                        @endif
                    @endforeach
                    {{--@foreach($plan_data as $value)--}}
                        {{--@if(!empty($tailorder['plan']))--}}
                            {{--@if($tailorder['plan']==$value['tailorder_plan_name'])--}}
                                {{--<option value="{{$value['tailorder_plan_id']}}" selected>{{$value['tailorder_plan_name']}}</option>--}}
                            {{--@else--}}
                                {{--<option value="{{$value['tailorder_plan_id']}}">{{$value['tailorder_plan_name']}}</option>--}}
                            {{--@endif--}}
                        {{--@else--}}
                            {{--<option value="{{$value['tailorder_plan_id']}}">{{$value['tailorder_plan_name']}}</option>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                </select>
            </div>
            {{--<button type='button' class="layui-btn layui-btn-normal" onclick="x_admin_show('添加跟单进度','tailorderPlanAdd',300,200)" ><i class="layui-icon"></i></button>--}}
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>跟单对象
            </label>
            <div class="layui-input-inline">
                <select lay-filter="mem" id="shipping" name="username" class="valid" lay-verify="required">
                    <option value="">请选择</option>
                    @foreach($user_data as $value)
                        @if($value['user_id'] == $tailorder_data['user_id'])
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
                <span class="x-red">*</span>下次联系
            </label>
            <div class="layui-input-inline">
                <input value="{{date('Y-m-d H:i:s',$tailorder_data['time'])}}" lay-filter="mem" type="text" class="layui-input" id="test5" placeholder="yyyy-MM-dd HH:mm:ss" name="time" lay-verify="required">
            </div>
        </div>

    <div class="layui-form-item layui-form-text">
    <label for="desc" class="layui-form-label">
        详细内容
    </label>
    <div class="layui-input-block">
        <textarea lay-filter="mem" lay-change="" placeholder="请输入内容" id="desc" name="tailorder_contents" class="layui-textarea" lay-verify="required">{{$tailorder_data['tailorder_contents']}}</textarea>
    </div>
</div>
    <div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn" lay-filter="upd" lay-submit="">
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
        form.on('submit(upd)', function(data){

            $.ajax({
                url:'tailorderUpdDo',
                data:'type='+data.field.tailorder_type+
                     '&plan='+data.field.tailorder_plan+
                     '&username='+data.field.username+
                     '&time='+data.field.time+
                     '&contents='+data.field.tailorder_contents+
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