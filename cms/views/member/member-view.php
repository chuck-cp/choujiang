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
					<input type="text" class="layui-input activity_title" placeholder="请输入参与活动名称" />
				</div>
                <div class="layui-input-inline">
					<input type="text" class="layui-input prize_code" placeholder="请输入获奖码" />
				</div>
                <div class="layui-input-inline">
                    <select id="prize_title" name="prize_title">
                        <option>请选择所中奖项</option>
                        <option value="一等奖">一等奖</option>
                        <option value="二等奖">二等奖</option>
                        <option value="三等奖">三等奖</option>
                        <option value="无">无</option>
                    </select>
                </div>
				<a class="layui-btn search_btn" data-type="reload">搜索</a>
			</div>
		</form>
	</blockquote>
	<table id="memberViewList" lay-filter="memberViewList"></table>
    <input type="hidden" value="<?echo $member_id?>" id="member_id">
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/memberViewList.js?v=201907284"></script>
</body>
</html>