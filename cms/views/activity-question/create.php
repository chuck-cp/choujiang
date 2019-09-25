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
<form class="layui-form" style="width:80%;">
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">问题标题</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input title" name="title" lay-verify="required" placeholder="请输入问题标题">
		</div>
	</div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">问题描述</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" name="description" lay-verify="required" placeholder="请输入问题描述">
		</div>
	</div>
    <!--<div class="layui-row">
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">问题样式</label>
            <div class="layui-input-block">
                <select name="select_type" lay-verify="required">
                    <option value="0">多选</option>
                    <option value="1">单选</option>
                </select>
            </div>
        </div>
    </div>-->
    <div id="prize-id">
        <div class="layui-row">
            <div class="layui-form-item layui-row layui-col-xs12">
                <div class="prize">
                    <label class="layui-form-label">答案1</label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input name" name="answer1"  placeholder="请输入答案" style="width: 180px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="prize-id">
        <div class="layui-row">
            <div class="layui-form-item layui-row layui-col-xs12">
                <div class="prize">
                    <label class="layui-form-label">答案2</label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input name" name="answer2"  placeholder="请输入答案" style="width: 180px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="prize-id">
        <div class="layui-row">
            <div class="layui-form-item layui-row layui-col-xs12">
                <div class="prize">
                    <label class="layui-form-label">答案3</label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input name" name="answer3"  placeholder="请输入答案" style="width: 180px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="prize-id">
        <div class="layui-row">
            <div class="layui-form-item layui-row layui-col-xs12">
                <div class="prize">
                    <label class="layui-form-label">答案4</label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input name" name="answer4"  placeholder="请输入答案" style="width: 180px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="prize-">
        <div class="layui-row">
            <div class="layui-form-item layui-row layui-col-xs12">
                <div class="prize">
                    <label class="layui-form-label">正确答案</label>
                    <div class="layui-input-block correct_answer_ck">
                        <input type="checkbox" id="1" name="correct_answer1" title="答案1" lay-skin="primary" value="1">
                    </div>
                </div>
                <div class="prize">
                    <div class="layui-input-block correct_answer_ck">
                        <input type="checkbox" id="2" name="correct_answer2" title="答案2" lay-skin="primary" value="2">
                    </div>
                </div>
                <div class="prize">
                    <div class="layui-input-block correct_answer_ck">
                        <input type="checkbox" id="3" name="correct_answer3" title="答案3" lay-skin="primary" value="3">
                    </div>
                </div>
                <div class="prize">
                    <div class="layui-input-block correct_answer_ck">
                        <input type="checkbox" id="4" name="correct_answer4" title="答案4" lay-skin="primary" value="4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="layui-row">
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <button type="button" class="layui-btn layui-btn-sm layui-btn-normal add-prize">增加奖项</button>
            </div>
        </div>
    </div>-->
    <div class="layui-form-item">
        <label class="layui-form-label">答题类型</label>
        <div class="layui-input-block">
            <input type="radio" name="question_type" value="1" title="必答题" checked="">
            <input type="radio" name="question_type" value="2" title="选答题">
        </div>
    </div>
    <div class="layui-form-item layui-row layui-col-xs12">
        <label class="layui-form-label">获奖码数量</label>
        <div class="layui-input-block">
            <input style="width: 180px;" type="text" class="layui-input name" name="prize_code_number" lay-verify="required" placeholder="答题得获奖码">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">活动页显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_activity" value="1" title="显示" checked="">
            <input type="radio" name="is_activity" value="2" title="不显示">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">领奖页显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_prize" value="1" title="显示" checked="">
            <input type="radio" name="is_prize" value="2" title="不显示">
        </div>
    </div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<div class="layui-input-block">
			<button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="addquestion">立即添加</button>
			<button type="reset" class="layui-btn layui-btn-sm layui-btn-primary">取消</button>
		</div>
	</div>
</form>
<style>
    .layui-unselect{width: 180px;}
    .prize{float: left;}
    .layui-form-radio{width: 100px;}
    .layui-form-checkbox{width: 79px;}
    .correct_answer_ck{width:5px;}
</style>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/activityQuestionAdd.js?v=20190711"></script>
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