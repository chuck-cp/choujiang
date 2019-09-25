<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>开奖详情</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/static/css/public.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form">
    <blockquote class="layui-elem-quote quoteBox">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" class="layui-input member_name" placeholder="获奖人用户名" />
            </div>
            <div class="layui-input-inline">
                <input type="text" class="layui-input prize_title" placeholder="所获奖项" />
            </div>
            <div class="layui-input-inline">
                <input type="text" class="layui-input prize_code" placeholder="获奖码" />
            </div>
            <a class="layui-btn search_btn" data-type="reload">搜索</a>
        </div>
        <a class="layui-btn layui-btn layui-btn-warm" href="index.php?r=activity/management-view-export&cid=<?echo$cid?>">导出</a>
    </blockquote>
	<table id="managementViewList" lay-filter="managementViewList"></table>
    <input type="hidden" value="<?echo $cid?>" id="cid">
</form>

<script type="text/javascript" src="/static/layui/layui.js?v=78787"></script>
<script type="text/javascript" src="/static/layui/layui.all.js?v=78787"></script>
<script type="text/javascript" src="/static/js/managementViewList.js?v=20190713"></script>

</body>
</html>