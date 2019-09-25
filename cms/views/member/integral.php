<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>积分操作</title>
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
    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
            <tbody>
            <tr>
                <td style="width: 60px;">姓名</td>
                <td><?php echo $model->name?></td>
            </tr>
            <tr>
                <td>手机号</td>
                <td><?php echo $model->mobile?></td>
            </tr>
            <tr>
                <td>当前积分</td>
                <td><?php echo $model->integral?></td>
            </tr>
            <tr>
                <td>消费类型</td>
                <td>
                    <div class="layui-col-md12">
                        <input type="radio" name="type" value="1" title="收入" checked><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>收入</div></div>
                        <input type="radio" name="type" value="2" title="消费"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon layui-anim-scaleSpring"></i><div>消费</div></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>消费积分</td>
                <td>
                    <div class="layui-col-md12">
                        <input type="text" class="layui-input integral" lay-verify="required" value="0" placeholder="请输入积分">
                    </div>
                </td>
            </tr>
            <tr>
                <td>备注</td>
                <td>
                    <div class="layui-col-md12">
                        <textarea class="layui-input description" style="height: 100px; padding: 10px"></textarea>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
	<div class="layui-form-item layui-row layui-col-xs12">
		<div class="layui-input-block">
            <input type="hidden" class="member_id" value="<?php echo $model->id?>">
			<button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="addIntegral">提交</button>
			<button type="reset" class="layui-btn layui-btn-sm layui-btn-primary">取消</button>
		</div>
	</div>
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/integralAdd.js"></script>
</body>
</html>