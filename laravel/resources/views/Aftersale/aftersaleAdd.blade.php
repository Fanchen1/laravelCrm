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
            <label class="layui-form-label">相关产品</label>
            <div class="layui-input-inline">
                <select name="product_id" >
                    <option value="0">请选择</option>
                    @foreach($product as $v)
                        <option value="{{$v['product_id']}}">{{$v['product_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_user_name" class="layui-form-label">
                <span class="x-red">*</span>反馈主题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="aftersale_issue" name="aftersale_issue" placeholder="填写反馈主题"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">反馈分类</label>
            <div class="layui-input-inline">
                <select name="classify_id" >
                    <option value="0">请选择</option>
                    @foreach($classify as $v)
                        <option value="{{$v['classify_id']}}">{{$v['aftersale_classify']}}</option>
                    @endforeach
                </select>
            </div>
            <button class="layui-btn layui-btn-radius layui-btn-warm" type="button" onclick="x_admin_show('添加反馈分类','/index.php/aftersaleClassify',400,160)"> <i class="layui-icon">&#xe654;</i>添加</button>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">联系人</label>
            <div class="layui-input-inline">
                <select name="user_id" >
                    <option value="0">请选择</option>
                    @foreach($user_name as $v)
                        <option value="{{$v['user_id']}}">{{$v['user_name']}}</option>
                    @endforeach;
                </select>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">反馈日期</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="aftersale_time" placeholder="年-月-日">
                </div>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">详情备注</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" name="aftersale_contents"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否解决</label>
            <div class="layui-input-block" id="isis">
                <input type="radio" name="is_solve" value="1" title="未解决" checked="">
                <input type="radio" name="is_solve" value="2" title="已解决">

            </div>

        </div>

        <div class="layui-inline">
            <label class="layui-form-label">结束日期</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" id="result_time" name="result_time" placeholder="年-月-日" disabled>
            </div>
        </div><br><br>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">处理结果</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" name="result" disabled></textarea>
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
    layui.use(['form','code'], function(){
        form = layui.form;
        layui.code();
        $('#x-city').xcity('北京','市辖区','东城区');
    });
</script>

<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //常规用法
        laydate.render({
            elem: '[name=aftersale_time]'
        });
        //常规用法
        laydate.render({
            elem: '[name=result_time]'
        });
    });

</script>

<script>
    $('#isis').click(function(){
        var is =$('[name=is_solve]:checked').val();
        if(is == 2){
            $('[name=result_time]').attr('disabled',false);
            $('[name=result]').attr('disabled',false);
        }else{
            $('[name=result_time]').attr('disabled',true);
            $('[name=result]').attr('disabled',true);
        }

    });

    $('[name=add]').on('click',function(){
        var product_id = $('[name=product_id]').val();//相关产品
        var aftersale_issue = $('[name=aftersale_issue]').val();//反馈主题
        var classify_id = $('[name=classify_id]').val();//反馈分类
        var user_id = $('[name=user_id]').val();//联系人
        var aftersale_time = $('[name=aftersale_time]').val();//反馈日期
        var aftersale_contents = $('[name=aftersale_contents]').val();//详情备注
        var is_solve = $('[name=is_solve]:checked').val();//是否解决
        var result_time = $('[name=result_time]').val();//结束日期
        var result = $('[name=result]').val();//处理结果

        if(product_id == 0){
            layer.msg('请选择相关产品',{icon:2});
            return false;
        }
        if(aftersale_issue == ''){
            layer.msg('反馈主题不能为空',{icon:2});
            return false;
        }
        if(classify_id == 0){
            layer.msg('请选择反馈分类',{icon:2});
            return false;
        }
        if(user_id == 0){
            layer.msg('请选择联系人',{icon:2});
            return false;
        }
        if(aftersale_time == ''){
            layer.msg('反馈日期不能为空',{icon:2});
            return false;
        }
        if(aftersale_contents == ''){
            layer.msg('请填写详情备注',{icon:2});
            return false;
        }
        var  data = '';
        if(is_solve == 1){
          data = 'product_id='+product_id+'&aftersale_issue='+aftersale_issue+'&classify_id='+classify_id+'&user_id='+user_id+'&aftersale_time='+aftersale_time+'&aftersale_contents='+aftersale_contents+'&is_solve='+is_solve+'&_token='+'{{csrf_token()}}';
        }else{
            if(result_time == ''){
                layer.msg('请填写结束日期',{icon:2});
                return false;
            }
            if(result == ''){
                layer.msg('请填写处理结果',{icon:2});
                return false;
            }
            data ='product_id='+product_id+'&aftersale_issue='+aftersale_issue+'&classify_id='+classify_id+'&user_id='+user_id+'&aftersale_time='+aftersale_time+'&aftersale_contents='+aftersale_contents+'&is_solve='+is_solve+'&result_time='+result_time+'&result='+result+'&_token='+'{{csrf_token()}}';
        }



        $.ajax({
            url: '/index.php/aftersaleAddDo',
            type: 'post',
            data: data,
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