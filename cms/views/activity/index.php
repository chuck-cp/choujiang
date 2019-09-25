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
                    <input type="text" class="layui-input activity_id" placeholder="请输入活动ID" />
                </div>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input activity_title" placeholder="请输入活动名称" />
                </div>
               <div class="layui-input-inline">
                    <select id="status" name="status" lay-verify="required">
                        <option>选择活动状态</option>
                        <option value="0">未发布</option>
                        <option value="1">已发布</option>
                        <option value="2">已完成</option>
                    </select>
                </div>
				<a class="layui-btn search_btn" data-type="reload">搜索</a>
			</div>
		</form>
	</blockquote>
    <blockquote class="layui-elem-quote quoteBox">
        <a class="layui-btn layui-btn-normal add-activity">新增活动</a>
        <button class="layui-btn layui-form-onswitch batch" data-type="getCheckData">批量发布</button>
        <button class="layui-btn layui-btn-danger batch" data-type="getCheckLength">批量撤销发布</button>
    </blockquote>
	<table id="activityList" lay-filter="activityList"></table>
</form>
<!--操作-->
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/activityList.js?v=201907155"></script>
</body>
</html>