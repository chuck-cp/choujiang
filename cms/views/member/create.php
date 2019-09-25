<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加会员</title>
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
<form class="layui-form" style="width:80%;">
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">姓名</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input name" lay-verify="required" placeholder="请输入登录名">
		</div>
	</div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">手机号</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" lay-verify="required" placeholder="请输入手机号">
		</div>
	</div>
	<div class="layui-row">
        <div class="layui-form-item layui-row layui-col-xs12">
			<label class="layui-form-label">积分</label>
			<div class="layui-input-block">
                <input type="text" class="layui-input integral" lay-verify="required" value="0" placeholder="请输入积分">
			</div>
		</div>
	</div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<div class="layui-input-block">
			<button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="addUser">立即添加</button>
			<button type="reset" class="layui-btn layui-btn-sm layui-btn-primary">取消</button>
		</div>
	</div>
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/userAdd.js"></script>
</body>
</html>