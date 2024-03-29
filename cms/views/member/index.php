<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用户中心</title>
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
		<form class="layui-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<input type="text" class="layui-input mobile" placeholder="请输入用户名" />
				</div>
                <div class="layui-input-inline">
                    <select id="from" name="from" lay-verify="required">
                        <option>选择参与来源</option>
                        <option value="1">APP</option>
                        <option value="2">微信公众号</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select id="status" name="status" lay-verify="required">
                        <option>选择参与状态</option>
                        <option value="1">正常</option>
                        <option value="2">无资格</option>
                    </select>
                </div>
				<a class="layui-btn search_btn" data-type="reload">搜索</a>
			</div>
		</form>
	</blockquote>
	<table id="memberList" lay-filter="memberList"></table>

	<!--操作-->
	<script type="text/html" id="userListBar">
        <a class="layui-btn layui-btn-xs layui-form-onswitch" lay-event="see-details">恢复资格</a>
        <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="see-details">取消资格</a>
        <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="see-details">查看详情</a>
	</script>
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/memberList.js?v=20190709"></script>
</body>
</html>