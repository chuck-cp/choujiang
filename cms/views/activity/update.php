<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>修改活动</title>
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
<form class="layui-form" style="width:80%;" id="qq">
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">活动名称</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input name" name="title" value="<?=$model->title?>" lay-verify="required" placeholder="请输入活动名称">
		</div>
	</div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<label class="layui-form-label">活动副标题</label>
		<div class="layui-input-block">
			<input type="text" class="layui-input mobile" name="subtitle" value="<?=$model->subtitle?>" lay-verify="required" placeholder="请输入活动副标题">
		</div>
	</div>
	<div class="layui-row">
        <div class="layui-form-item layui-row layui-col-xs12">
            <div class="prize">
                <label class="layui-form-label">活动时间</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="start_at" value="<?=$model->start_at?>"  id="start_at" lay-verify="required" placeholder="开始时间" name="createtime" style="height:38px;width:180px;">
                </div>
            </div>
            <div class="prize">
                <label  class="layui-form-label"></label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="end_at" id="end_at" value="<?=$model->end_at?>" lay-verify="required" placeholder="结束时间" name="createtime" style="height:38px;width:180px;">
                </div>
            </div>
		</div>
	</div>
    <div class="layui-row">
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">开奖时间</label>
            <div class="layui-input-block">
                <select name="prize_time" lay-verify="required">
                    <option value="1" <?if($model->prize_time==1):?>selected="selected" <?endif;?>>上午</option>
                    <option value="2" <?if($model->prize_time==2):?>selected="selected" <?endif;?>>下午</option>
                </select>
            </div>
        </div>
    </div>
    <div id="prize-id">
        <?foreach ($prizeModel as $key=>$value):?>
            <input type="hidden" name="prize_id[]" value="<?=$value['id']?>">
            <div class="layui-row" id="max<?=$key+1?>">
                <div class="layui-form-item layui-row layui-col-xs12">
                    <div class="prize">
                        <label class="layui-form-label">奖项名称</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input prize_title" name="prize_title[]" lay-verify="required" value="<?=$value['prize_title']?>" placeholder="请输入奖项名称" style="width: 180px;">
                        </div>
                    </div>
                    <div class="prize">
                        <label class="layui-form-label">获奖人数</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input name" name="prize_number[]" lay-verify="required" value="<?=$value['prize_number']?>" placeholder="请输入获奖人数" style="width: 180px;">
                        </div>
                    </div>
                    <div class="prize">
                        <label class="layui-form-label">奖品</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input name" name="prize_name[]" value="<?=$value['prize_name']?>"  lay-verify="required" placeholder="请输入奖品" style="width: 180px;">
                        </div>
                    </div>
                    <div class="prize">
                        <label class="layui-form-label">奖品类型</label>
                        <div class="layui-input-block">
                            <select name="prize_type[]" lay-verify="required">
                                <option value="1" <?if($value['prize_type']==1):?>selected="selected" <?endif;?>>实物</option>
                                <option value="2" <?if($value['prize_type']==2):?>selected="selected" <?endif;?>>现金</option>
                            </select>
                        </div>
                    </div>
                    <div class="prize">
                        <div class="layui-input-block">
                            <div style="float: left;<?if($key==0):?>width:145px; <?endif;?>">
                                <?if($key>0):?>
                                    <button style="margin-top: 20px;" type="button" class="layui-btn layui-btn-sm layui-btn layui-btn-danger del-prize" maxid="max<?=$key+1?>" prize-id="<?=$value['id']?>">删除奖项</button>
                                <?endif;?>
                                <button style="margin-top: 20px;" type="button" cid="<?=$key+1?>" class="layui-btn layui-btn-sm imgs" >上传图片</button>
                            </div>
                            <div style="float: left; margin-left: 20px;" class="layui-upload-list">
                                <img width="35%" class="layui-upload-img" src="<?=$value['prize_image']?>" id="img<?=$key+1?>" >
                                <input type="hidden" name="prize_image[]" value="<?=$value['prize_image']?>" id="prize_image<?=$key+1?>" id="prize_image<?=$key+1?>">
                                <p id="demoText"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
    <div class="layui-row">
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <button type="button" class="layui-btn layui-btn-sm layui-btn-normal add-prize" zid="<?=count($prizeModel)?>">增加奖项</button>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">显示必答题</label>
        <div class="layui-input-block">
            <input type="radio" name="is_must" value="1" title="是" <?if($model->is_must==1):?>checked="checked" <?endif;?> >
            <input type="radio" name="is_must" value="0" title="否" <?if($model->is_must==0):?>checked="checked" <?endif;?>>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">显示选则题</label>
        <div class="layui-input-block">
            <input type="radio" name="is_choice" value="1" title="是" <?if($model->is_choice==1):?>checked="checked" <?endif;?>>
            <input type="radio" name="is_choice" value="0" title="否" <?if($model->is_choice==0):?>checked="checked" <?endif;?>>
        </div>
    </div>
	<div class="layui-form-item layui-row layui-col-xs12">
		<div class="layui-input-block">
			<button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="updateActivity">立即修改</button>
			<button type="reset" class="layui-btn layui-btn-sm layui-btn-primary">取消</button>
		</div>
	</div>
    <input type="hidden" id="id" value="<?=$id?>">
</form>
<style>
    .layui-unselect{width: 180px;}
    .prize{float: left;}
    .layui-form-radio{width: 100px;}
</style>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/activityAdd.js?v=20190729"></script>
<script type="text/javascript" src="/static/layui/lay/modules/laydate.js"></script>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start_at',
            type: 'date'
        });
        laydate.render({
            elem: '#end_at',
            type: 'date'
        });
    });
</script>
</body>
</html>