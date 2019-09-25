<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>资格详情</title>
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

<table class="layui-table"  lay-filter="demo">
    <thead>
        <tr>
            <th >ID</th>
            <th >原因</th>
            <th >状态</th>
            <th >操作时间</th>
            <th >操作人</th>
        </tr>
    </thead>
    <tbody>
        <?if(!empty($memberLogData)):?>
            <?foreach ($memberLogData as $k=>$v):?>
                <tr>
                    <td><?echo $v['id']?></td>
                    <td><?echo $v['descition']?></td>
                    <td><?echo $v['status']==1?'正常':'无资格'?></td>
                    <td><?echo $v['create_at']?></td>
                    <td><?echo $v['create_user_name']?></td>
                </tr>
            <?endforeach;?>
        <?else:?>
            <tr>
                <td colspan="5">无资格操作详情</td>
            </tr>
        <?endif;?>
    </tbody>
</table>
</body>
</html>