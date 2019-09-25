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
	<table id="partakeViewList" lay-filter="partakeViewList"></table>
    <input type="hidden" value="<?echo $id?>" id="acvtiity_id">
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" >
    layui.use(['form','layer','table','laytpl'],function(){
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery,
            laytpl = layui.laytpl,
            table = layui.table;
        var acvtiity_id = $('#acvtiity_id').val();
        //用户列表
        var tableIns = table.render({
            elem: '#partakeViewList',
            url : 'index.php?r=activity/partake-view&id='+acvtiity_id,
            cellMinWidth : 95,
            page : true,
            height : "full-60",
            limits : [10,15,20,25],
            limit : 20,
            id : "partakeViewListTable",
            cols : [[
                //{type: "checkbox", fixed:"left", width:50},
                {field: 'did', title: 'ID', width:80, align:"center"},
                {field: 'create_at', title: '参与时间', minWidth:200, align:"center"},
                {field: 'member_number', title: '用户名', minWidth:200, align:'center'},
                {field: 'from', title: '来源',width:200, align:'center',templet:function(d){
                    if(d.from == "1"){
                        return "APP";
                    }else if(d.status == "2"){
                        return "微信公众号";
                    }
                }},
                {field: 'prize_code', title: '获奖码', minWidth:200, align:'center'},
                {field: 'grant_style', title: '获奖方式', minWidth:200, align:'center'},
            ]]
        });
    })
</script>

</body>
</html>