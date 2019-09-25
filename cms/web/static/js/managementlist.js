layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;

    //用户列表
    var tableIns = table.render({
        elem: '#managementlist',
        url : 'index.php?r=activity/management',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [10,15,20,25],
        limit : 20,
        id : "managementlistTable",
        cols : [[
            {field: 'cid', title: '获奖id', width:80, align:"center"},
            {field: 'activity_id', title: '活动ID', width:80, align:"center"},
            {field: 'title', title: '活动名称', minWidth:350, align:'center'},
            {field: 'start_at', title: '活动开始时间', width:180, align:'center'},
            {field: 'end_at', title: '活动结束时间', width:180, align:'center'},
            {field: 'prize_date', title: '开奖时间', width:150, align:'center'},
            {field: 'prize_number', title: '获奖数量', width:100, align:'center'},
            {field: 'receive_prize_number', title: '领奖人数', width:100, align:'center'},
            {title: '操作', width:170, align:'center',templet:function(d){
                    return "<a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"management-view\">查看详情</a>";
                }
            },
        ]]
    });
    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        if($(".activity_id").val() != '' || $(".activity_title").val() != '' ){
            table.reload("activityListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    activity_id: $(".activity_id").val(),
                    activity_title: $(".activity_title").val(),
                }
            })
        }else{
            layer.msg("请输入搜索的内容");
        }
    });

    table.on('tool(managementlist)', function(obj){
        var data = obj.data;
        if(obj.event === 'management-view'){
            var index = layui.layer.open({
                title : "查看详情",
                type : 2,
                content : "index.php?r=activity/management-view&cid="+data.cid,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回列表页', '.layui-layer-setwin .layui-layer-close', {
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
