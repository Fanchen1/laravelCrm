<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body><center>
    @foreach( $user as $v )
        <div>
            <span style="color: #3289ff">{{$v['user_name']}}</span>   发表过的评论标题有
            @foreach( $v['com'] as $vv )
                <span>
            （评论 id:{{$vv['com_id']}}）  标题：<span style="color: #ff188e">{{$vv['title']}}</span>
        </span>
            @endforeach
        </div>
    @endforeach
</center>
</body>
</html>