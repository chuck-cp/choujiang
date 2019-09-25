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
	<blockquote class="layui-elem-quote quoteBox">
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">总点击数：<span style="font-weight: bold;font-size: 25px;"><?=$dataCount['browse_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">参与总人数：<span style="font-weight: bold;font-size: 25px;"><?=$dataCount['member_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">获奖码总数：<span style="font-weight: bold;font-size: 25px;"><?=$dataCount['prize_code_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">获奖人总数：<span style="font-weight: bold;font-size: 25px;"><?=$dataCount['prize_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">领奖人总数：<span style="font-weight: bold;font-size: 25px;"><?=$dataCount['receive_prize_number']?></span></button>
	</blockquote>
	<table id="activityCountList" lay-filter="activityCountList"></table>
</form>
<style>
    .count{float: left;}
</style>
<!--操作-->
<script type="text/javascript" src="/static/layui/layui.js"></script>

<script type="text/javascript">
    layui.use(['form','layer','table','laytpl'],function(){
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery,
            laytpl = layui.laytpl,
            table = layui.table;
        //用户列表
        var tableIns = table.render({
            elem: '#activityCountList',
            url : 'index.php?r=activity/activity-count',
            cellMinWidth : 95,
            page : true,
            height : "full-125",
            limits : [10,15,20,25],
            limit : 20,
            id : "activityCountListTable",
            cols : [[
                {field: 'id', title: '活动ID',width:80, align:"center"},
                {field: 'title', title: '活动名称', minWidth:200, align:'center'},
                {field: 'start_at', title: '活动开始时间', width:200, align:'center'},
                {field: 'end_at', title: '活动结束时间', width:200, align:'center'},
                {field: 'browse_number', title: '点击量', width:100, align:'center'},
                {field: 'member_number', title: '参与人数', width:100, align:'center'},
                {field: 'prize_code_number', title: '获奖码数', width:100, align:'center'},
                {field: 'prize_number', title: '获奖数量', width:100, align:'center'},
                {field: 'receive_prize_number', title: '领奖人数', width:100, align:'center'},
                {title: '操作', width:146, align:'center',templet:function(d){
                        return "<a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"activity-count-view\">查看详情</a>"
                }},
            ]]
        });
        //监听工具条
        table.on('tool(activityCountList)', function(obj){
            var data = obj.data;
            if(obj.event === 'activity-count-view'){
                var index = layui.layer.open({
                    title : "统计操作",
                    type : 2,
                    content : "index.php?r=activity/activity-count-view&activity_id="+data.id,
                    success : function(layero, index){
                        var body = layui.layer.getChildFrame('body', index);
                        setTimeout(function(){
                            layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                                tips: 3
                            });
                        },500)
                    }
                })
                layui.layer.full(index);
                window.sessionStorage.setItem("index",index);
                //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
                $(window).on("resize",function(){
                    layui.layer.full(window.sessionStorage.getItem("index"));
                })
            }
        });




    })
</script>
</body>
</html>