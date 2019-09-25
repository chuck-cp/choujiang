<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>参与活动人员统计</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/static/css/public.css" media="all" />
	<link rel="stylesheet" href="/static/laydate/theme/default/laydate.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form">
	<blockquote class="layui-elem-quote quoteBox">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" class="layui-input prize_date" id="test1" placeholder="yyyy-MM-dd">
            </div>
            <div class="layui-input-inline">
                <input type="text" class="layui-input prize_date_end" id="test2" placeholder="yyyy-MM-dd">
            </div>
            <a class="layui-btn search_btn" data-type="reload">搜索</a>
            <a class="layui-btn layui-btn layui-btn-warm" href="index.php?r=member/member-count-export">导出</a>
        </div>
        <br/>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary"><span style="font-weight: bold;font-size: 25px;"><?=date('Y-m-d')?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">注册用户数：<span style="font-weight: bold;font-size: 25px;"><?=$memberCount['member_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">参加活动的人数：<span style="font-weight: bold;font-size: 25px;"><?=$memberCount['member_activity_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">新增注册用户：<span style="font-weight: bold;font-size: 25px;"><?=$memberCount['new_member_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">新增参加活动人数：<span style="font-weight: bold;font-size: 25px;"><?=$memberCount['new_member_activity_number']?></span></button>
        <button type="button" class="layui-btn layui-btn-lg layui-btn-primary">当天参加活动的总人数：<span style="font-weight: bold;font-size: 25px;"><?=$memberCount['total_member_activity_number']?></span></button>
	</blockquote>
	<table id="memberCountList" lay-filter="memberCountList"></table>
</form>
<style>
    .count{float: left;}
</style>
<!--操作-->
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script src="/static/laydate/laydate.js"></script>
<script type="text/javascript">
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#test1'
        });
        laydate.render({
            elem: '#test2'
        });
    })

    layui.use(['form','layer','table','laytpl'],function(){
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery,
            laytpl = layui.laytpl,
            table = layui.table;
        //用户列表
        var tableIns = table.render({
            elem: '#memberCountList',
            url : 'index.php?r=member/member-count',
            cellMinWidth : 95,
            page : true,
            height : "full-125",
            limits : [20,50,100],
            limit : 20,
            id : "memberCountListTable",
            cols : [[
                {field: 'id', title: 'ID',width:80, align:"center"},
                {field: 'activity_id', title: '活动ID',width:80, align:"center"},
                {field: 'prize_date', title: '活动时间', width:200, align:'center'},
                {field: 'member_number', title: '注册用户数', width:200, align:'center'},
                {field: 'member_activity_number', title: '参加活动的人数', width:200, align:'center'},
                {field: 'new_member_number', title: '新增注册用户', width:200, align:'center'},
                {field: 'new_member_activity_number', title: '新增参加活动人数', width:200, align:'center'},
                {field: 'total_member_activity_number', title: '当天参加活动的总人数', width:200, align:'center'},
                // {title: '操作', width:146, align:'center',templet:function(d){
                //         return "<a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"member-count-view\">查看详情</a>"
                // }},
            ]]
        });
        //监听工具条
        table.on('tool(memberCountList)', function(obj){
            // var data = obj.data;
            // if(obj.event === 'member-count-view'){
            //     var index = layui.layer.open({
            //         title : "统计操作",
            //         type : 2,
            //         content : "index.php?r=activity/activity-count-view&activity_id="+data.id,
            //         success : function(layero, index){
            //             var body = layui.layer.getChildFrame('body', index);
            //             setTimeout(function(){
            //                 layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
            //                     tips: 3
            //                 });
            //             },500)
            //         }
            //     })
            //     layui.layer.full(index);
            //     window.sessionStorage.setItem("index",index);
            //     //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
            //     $(window).on("resize",function(){
            //         layui.layer.full(window.sessionStorage.getItem("index"));
            //     })
            // }
        });
        $(".search_btn").on("click",function(){
            table.reload("memberCountListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    prize_date: $(".prize_date").val(),
                    prize_date_end: $(".prize_date_end").val(),
                }
            })
        });
    })
</script>
</body>
</html>