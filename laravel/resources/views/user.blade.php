<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
@foreach( $user as $k=>$v )
    <div>
        <span style="color:blueviolet">{{$k}}</span>   发表过的评论标题有
        @foreach( $v as $kk=>$vv )
            <span>
            （评论 id:{{$vv['c_id']}}）  标题：{{$vv['title']}}
        </span>
        @endforeach
    </div>
@endforeach

</body>
</html>