<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>活动数据统计</title>
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
    <div class="layui-form">
        <?if(!empty($countArray)):?>
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>开奖日期</th>
                <?foreach ($title as $v):?>
                    <th><?=$v?></th>
                <?endforeach;?>
            </tr>
            </thead>
            <tbody>
            <?foreach ($countArray as $kk=>$vv):?>
                <tr>
                    <td><?=$kk?></td>
                    <?foreach ($idarr as $vvv):?>
                        <th>
                            <?if(isset($vv[$vvv])):?>
                                <?=$vv[$vvv]?>
                            <?else:?>
                                0
                            <?endif;?>
                        </th>
                    <?endforeach;?>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
        <?else:?>
            暂无统计详情
        <?endif;?>
    </div>
</form>

<!--操作-->
<script type="text/javascript" src="/static/layui/layui.js"></script>


</body>
</html>