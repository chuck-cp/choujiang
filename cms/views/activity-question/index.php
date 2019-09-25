<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>活动问题管理</title>
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
        <a class="layui-btn layui-btn-normal problem" data-type="reload">添加问题</a>
	</blockquote>
	<table id="activityQuestionList" lay-filter="activityQuestionList"></table>

	<!--操作-->
	<script type="text/html" id="ActivityQuestionListBar">
        <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="see-details"></a>
	</script>
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/activityQuestionList.js?v=20190709"></script>
</body>
</html>