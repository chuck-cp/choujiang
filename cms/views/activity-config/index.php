<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新增问题</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/static/layui/css/modules/laydate/default/laydate.css" media="all" />
	<link rel="stylesheet" href="/static/css/public.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form" style="width:80%; id='updateConfigId'">
    <div class="layui-form-item layui-row layui-col-xs12">
        <label class="layui-form-label">客服电话:</label>
        <div class="layui-input-block">
            <input type="text" name="customer_service_telephone" value="<?=$data['customer_service_telephone']?>"   class="layui-input name"  >
        </div>
    </div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">每人每期获得最多获奖码:</label>
		<div class="layui-input-block">
			<input type="text" name="maximum_winning_number" value="<?=$data['maximum_winning_number']?>" class="layui-input name"  >
		</div>
	</div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">每人每期活动可获奖次数:</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" name="issue_prize_number" value="<?=$data['issue_prize_number']?>"  placeholder="每人每期活动可获奖次数">
		</div>
	</div>
    <div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">每人每期每次可获奖次数:</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" name="every_prize_number" value="<?=$data['every_prize_number']?>"  placeholder="每人每期每次可获奖次数">
		</div>
	</div>
    <div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">领取奖品失效时长:</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" name="award_acceptance_period" value="<?=$data['award_acceptance_period']?>" placeholder="领取奖品失效时长">
		</div>
	</div>
    <div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">现金兑优惠券比例:</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" name="cash_to_coupon_rate" value="<?=$data['cash_to_coupon_rate']?>" placeholder="现金兑优惠券比例">
		</div>
	</div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<div class="layui-input-block">
			<button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="updateConfig">提交</button>
		</div>
	</div>
</form>
<style>
    .layui-unselect{width: 180px;}
    .prize{float: left;}
    .layui-form-radio{width: 100px;}
    .layui-form-label{width: 200px;}
    .layui-input{width: 400px;}
</style>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/activityConfig.js?v=20190707"></script>
<script type="text/javascript" src="/static/layui/lay/modules/laydate.js"></script>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#test5',
            type: 'datetime'
        });
        laydate.render({
            elem: '#test6',
            type: 'datetime'
        });

    });
</script>
</body>
</html>