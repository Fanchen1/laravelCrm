<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin2.0</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<<<<<<< HEAD
    <script src="/jquery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">
=======
    <link rel="stylesheet" href="/Admin/css/font.css">
    <link rel="stylesheet" href="/Admin/css/xadmin.css">
    <script type="text/javascript" src="/Admin/js/jquery-3.2.1.min.js"></script>
    <script src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <script src="{{asset('/jquery/jquery-3.2.1.min.js')}}"></script>
>>>>>>> 1d2c295046ecd4b56168ddeb684cb0714e1b9673

    <script src="/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/layer/layer.js"></script>
    <script type="text/javascript" src="/layer/mobile/need/layer.css"></script>

</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="/index">最牛b的开发团队 1803(2)组</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{$user}}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
                <dd><a href="/">切换帐号</a></dd>
                <dd><a href="quit">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/index.php/userList">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>用户列表</cite>

                        </a>
                    </li >
<<<<<<< HEAD
                    <li>
                        <a _href="member-del.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>用户删除</cite>

                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>用户管理</cite>
                            {{--<i class="iconfont nav_right">&#xe697;</i>--}}
                        </a>

                    </li>
=======
>>>>>>> 1d2c295046ecd4b56168ddeb684cb0714e1b9673
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/index.php/order">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单添加</cite>
                        </a>
                    </li >
                </ul>
                <ul class="sub-menu">
                    <li>
                        <a _href="/index.php/order_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
<<<<<<< HEAD
                    <cite>合同管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/pactAdd">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>合同添加</cite>
                        </a>
                    </li >
                </ul>
                <ul class="sub-menu">
                    <li>
                        <a _href="/pactList">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>合同列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>分类管理</cite>
=======
                    <cite>跟单管理</cite>
>>>>>>> 1d2c295046ecd4b56168ddeb684cb0714e1b9673
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/index.php/tailorderAdd">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>新增跟单</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/index.php/tailorderList">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>跟单列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>费用管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/index.php/costList">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>费用列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>售后管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/index.php/aftersaleList">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>售后列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="admin-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/index.php/PowerList">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="admin-role.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色管理</cite>
                        </a>
                    </li >

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ce;</i>
                    <cite>系统统计</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="echarts1.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>拆线图</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="echarts2.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>柱状图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts3.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>地图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts4.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>饼图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts5.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>雷达图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts6.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>k线图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts7.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>热力图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts8.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>仪表图</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b4;</i>
                    <cite>图标字体</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="unicode.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>图标对应字体</cite>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='welcome' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ?2017 x-admin v2.3 All Rights Reserved</div>
</div>
{{--<!-- 底部结束 -->--}}
{{--<script>--}}
    {{--//百度统计可去掉--}}
    {{--var _hmt = _hmt || [];--}}
    {{--(function() {--}}
        {{--var hm = document.createElement("script");--}}
        {{--hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";--}}
        {{--var s = document.getElementsByTagName("script")[0];--}}
        {{--s.parentNode.insertBefore(hm, s);--}}
    {{--})();--}}
{{--</script>--}}
</body>
</html>
