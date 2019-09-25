<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新增活动</title>
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

<div class="layui-form">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <td>活动名称</td>
            <td colspan="9"><?=$model->title?></td>
        </tr>
        <tr>
            <td>活动副标题</td>
            <td colspan="9"><?=$model->subtitle?></td>
        </tr>
        <tr>
            <td>活动时间</td>
            <td colspan="9"><?=$model->start_at?>&nbsp;&nbsp;至&nbsp;&nbsp;<?=$model->end_at?></td>
        </tr>
        <tr>
            <td>开奖时间</td>
            <td colspan="9"><?if($model->prize_time==1):?>上午<?else:?>下午<?endif;?></td>
        </tr>
        <tr>
            <td>显示选则题</td>
            <td colspan="9"><?if($model->is_choice==1):?>显示<?else:?>不显示<?endif;?></td>
        </tr>
        <tr>
            <td>显示必答题</td>
            <td colspan="9"><?if($model->is_must==1):?>显示<?else:?>不显示<?endif;?></td>
        </tr>
        <?foreach ($prizeModel as $k=>$v):?>
            <tr>
                <td>奖项名称</td>
                <td><?=$v['prize_title']?></td>
                <td>获奖人数</td>
                <td><?=$v['prize_number']?></td>
                <td>奖品</td>
                <td><?=$v['prize_name']?></td>
                <td>获奖类型</td>
                <td><?if($v['prize_type']==1):?>实物<?else:?>现金<?endif;?></td>
                <td>图片</td>
                <td><img width="30%" src="<?=$v['prize_image']?>"></td>
            </tr>
        <?endforeach;?>

        </tbody>
    </table>
</div>
<script type="text/javascript" src="/static/layui/layui.js"></script>
</body>
</html>