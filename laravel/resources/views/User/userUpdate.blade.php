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
    <form class="layui-form">


        <div class="layui-form-item">
            <label for="L_user_name" class="layui-form-label">
                <span class="x-red">*</span>客户名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_user_name" name="user_name" placeholder="填写客户姓名"
                       autocomplete="off" class="layui-input" value="{{$user_name['user_name']}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_user_tel" class="layui-form-label">
                <span class="x-red">*</span>手机号码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_user_tel" name="user_tel" placeholder="填写11位纯数字"
                       autocomplete="off" class="layui-input" value="{{$user_name['user_tel']}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">客户级别</label>
            <div class="layui-input-inline">
                <select name="rank" >
                    <option value="0">请选择</option>
                    @foreach($rank as $v)
                        @if($user_name['rank_id'] == $v['rank_id'] )
                                <option value="{{$v['rank_id']}}" selected>{{$v['user_rank']}}</option>
                        @else
                                <option value="{{$v['rank_id']}}">{{$v['user_rank']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">所选产品</label>
            <div class="layui-input-inline">
                <select name="product" >
                    <option value="0">请选择</option>
                    @foreach($product as $v)
                        @if($user_name['rank_id'] == $v['product_id'])
                            <option value="{{$v['product_id']}}" selected>{{$v['product_name']}}</option>
                        @else
                            <option value="{{$v['product_id']}}">{{$v['product_name']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item" id="x-city">
            <label class="layui-form-label">详细地址</label>
            <div class="layui-input-inline">
                <select name="user_province" lay-filter="province">
                    <option value="0">请选择省</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="user_city" lay-filter="city">
                    <option value="0">请选择市</option>
                </select>
            </div>
            <div class="layui-input-inline" >
                <select name="user_area" lay-filter="area">
                    <option value="0">请选择县/区</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <input type="text" id="L_repass" name="user_address" placeholder="详情地址"
                       value="{{$user_name['user_address']}}"
                       class="layui-input" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">客户类型</label>
            <div class="layui-input-inline">
                <select name="type" >
                    <option value="0">请选择</option>
                    @foreach($type as $v)
                        @if($user_name['type_id'] == $v['type_id'])
                            <option value="{{$v['type_id']}}" selected>{{$v['user_type']}}</option>
                        @else
                            <option value="{{$v['type_id']}}">{{$v['user_type']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="layui-btn layui-btn-radius layui-btn-warm" type="button" onclick="x_admin_show('添加客户类型','/index.php/userType',400,160)"> <i class="layui-icon">&#xe654;</i>添加</button>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">客户来源</label>
            <div class="layui-input-inline">
                <select name="source" >
                    <option value="0">请选择</option>
                    @foreach($source as $v)
                        @if($user_name['source_id'] == $v['source_id'])
                            <option value="{{$v['source_id']}}" selected>{{$v['user_source']}}</option>
                        @else
                            <option value="{{$v['source_id']}}">{{$v['user_source']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="layui-btn layui-btn-radius layui-btn-warm" type="button" onclick="x_admin_show('添加客户来源','/index.php/userSource',400,160)"> <i class="layui-icon">&#xe654;</i>添加</button>
        </div>


        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn layui-btn-radius layui-btn-normal" type="button" name="add">
                <i class="layui-icon">&#xe654;</i>
                一键更新
            </button>
        </div>
            <input type="hidden" value="{{$user_name['user_province']}}" id="province">
            <input type="hidden" value="{{$user_name['user_city']}}" id="city">
            <input type="hidden" value="{{$user_name['user_area']}}" id="area">
            <input type="hidden" value="{{$user_name['user_id']}}" id="user_id">
    </form>

</div>
<script>
    layui.use(['form','code'], function(){
        form = layui.form;
        layui.code();
        var   province =  $('#province').val();
        var   city =   $('#city').val();
        var   area =   $('#area').val();
        if(province!= '' && city != '' && area != ''){
            $('#x-city').xcity(province,city,area);
        }else{
            $('#x-city').xcity('北京','市辖区','东城区');
        }
    });
</script>


<script>
    $('[name=add]').on('click',function(){
        var user_id = $('#user_id').val();//客户当前 id
        var user_name = $('[name=user_name]').val();//客户姓名
        var user_tel = $('[name=user_tel]').val();//客户手机号
        var rank = $('[name=rank]').val();//客户级别
        var product = $('[name=product]').val();//产品
        var user_province = $('[name=user_province]').val();//省
        var user_city = $('[name=user_city]').val();//市
        var user_area = $('[name=user_area]').val();//区
        var user_address = $('[name=user_address]').val();//详情地址
        var type = $('[name=type]').val();//客户类型
        var source = $('[name=source]').val();//客户来源
        if(user_name == ''){
            layer.msg('客户姓名不能为空',{icon:2});
            return false;
        }
        if(user_tel == ''){
            layer.msg('客户手机号不能为空',{icon:2});
            return false;
        }
        var tel_reg = /^1\d{10}$/;
        if( !tel_reg.test( user_tel )){
            layer.msg('手机号码格式不正确',{icon:2});
            return false;
        }
        if(rank == 0){
            layer.msg('请选择客户级别',{icon:2});
            return false;
        }
        if(product == 0){
            layer.msg('请选择产品',{icon:2});

            return false;
        }
        if(user_address == ''){
            layer.msg('请填写详情地址',{icon:2});
            return false;
        }
        if(type == 0){
            layer.msg('请选择客户类型',{icon:2});
            return false;
        }
        if(source == 0){
            layer.msg('请选择客户来源',{icon:2});
            return false;
        }
        $.ajax({
            url: '/index.php/userUpdateDo',
            type: 'post',
            data: 'user_id='+user_id+'&user_name=' + user_name +'&user_tel='+user_tel+'&rank='+rank+'&product='+product+'&user_province='+user_province+'&user_city='+user_city+'&user_area='+user_area+'&user_address='+user_address+'&type='+type+'&source='+source+'&_token=' + '{{csrf_token()}}',
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