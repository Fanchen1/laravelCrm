<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    {{--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />--}}
    <link rel="stylesheet" href="Admin/css/font.css">
    <link rel="stylesheet" href="Admin/css/xadmin.css">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">


</head>
<body>
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">{{$user}}</span>！<br>当前时间:<script charset="utf-8" language="javascript" src="/Admin/clock.js"></script></blockquote>


    <blockquote class="layui-elem-quote layui-quote-nm">全球最牛b的开发团队，1803(2)组</blockquote>
    <div>
        {{----}}
    {{--</div>--}}
</div>

<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
//        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>
</html>