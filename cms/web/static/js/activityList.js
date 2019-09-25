layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;

    //用户列表
    var tableIns = table.render({
        elem: '#activityList',
        url : 'index.php?r=activity/index',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [10,15,20,25],
        limit : 20,
        id : "activityListTable",
        cols : [[
            {field: 'id',type: "checkbox", fixed:"left", width:30},
            {field: 'id', title: '活动ID', width:80, align:"center"},
            {field: 'title', title: '活动名称', width:358, align:'center'},
            {field: 'start_at', title: '活动开始时间', width:150, align:'center'},
            {field: 'end_at', title: '活动结束时间', width:150, align:'center'},
            {field: 'first_date', title: '开奖时间', width:150, align:'center'},
            {field: 'browse_number', title: '点击量', width:100, align:'center'},
            {field: 'member_number', title: '参与人数', width:100, align:'center'},
            {field: 'prize_number', title: '获奖数量', width:100, align:'center'},
            {field: 'status', title: '活动状态',width:120, align:'center',templet:function(d){
                if(d.status == "0"){
                    return "未发布";
                }else if(d.status == "1"){
                    return "已发布";
                }else if(d.status == "2"){
                    return "已完成";
                }
            }},
            {title: '操作', width:280, align:'center',templet:function(d){
                    if(d.status == "0"){
                        // return "<a class=\"layui-btn layui-btn-xs\" lay-event=\"edit\">修改</a>\n" +
                        return    "    <a class=\"layui-btn layui-btn-xs layui-form-onswitch\" lay-event=\"release\">发布</a>\n" +
                            "    <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"activity-view\">活动详情</a>\n"+
                            "    <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"partake-view\">参与详情</a>";
                    }else if(d.status == "1"){
                        // return "<a class=\"layui-btn layui-btn-xs\" lay-event=\"edit\">修改</a>\n" +
                        return    "    <a class=\"layui-btn layui-btn-xs layui-btn-danger\" lay-event=\"revoke\">撤销</a>\n" +
                            "    <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"activity-view\">活动详情</a>\n"+
                            "    <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"partake-view\">参与详情</a>";
                    }else if(d.status == "2"){
                        return "<a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"activity-view\">活动详情</a>\n"+
                            "    <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"partake-view\">参与详情</a>";
                    }
                }},
        ]]
    });

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        if($(".activity_id").val() != '' || $(".activity_title").val() != '' || $('#status option:selected').val() !='选择活动状态'){
            table.reload("activityListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    activity_id: $(".activity_id").val(),
                    activity_title: $(".activity_title").val(),
                    status: $('#status option:selected').val(),
                }
            })
        }else{
            layer.msg("请输入搜索的内容");
        }
    });


    //新增活动
    function addActivity(){
        var index = layui.layer.open({
            title : "新增活动",
            type : 2,
            content : "index.php?r=activity/create",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回活动列表', '.layui-layer-setwin .layui-layer-close', {
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
    $(".add-activity").click(function(){
        addActivity();
    })
    //监听工具条
    table.on('tool(activityList)', function(obj){
        var data = obj.data;
        if(obj.event === 'release'){
            layer.confirm('活动发布后将显示为活动进行中页面'+'<br />'+'请确定是否发布', {
                btn: ['确定','取消'], //按钮
                title:'发布'
            }, function(){
                $.post("/index.php?r=activity/state-operation",{
                    ids:data.id,
                    status:1,
                },function(res){
                    res = $.parseJSON(res);
                    if (res.code == 0) {
                        layer.msg("发布成功！",{icon:1});
                        //刷新父页面
                        location.reload();
                        return true;
                    }
                    layer.msg("发布失败！",{icon:2});
                    return true;
                })
            });
        } else if(obj.event === 'revoke'){
            layer.confirm('撤消发布后活动将显示为活动结束页面'+'<br />'+'请确定是否撤消？', {
                btn: ['确定','取消'], //按钮
                title:'撤销'
            }, function(){
                $.post("/index.php?r=activity/state-operation",{
                    ids:data.id,
                    status:0,
                },function(res){
                    res = $.parseJSON(res);
                    if (res.code == 0) {
                        layer.msg("撤销成功！",{icon:1});
                        //刷新父页面
                        location.reload();
                        return true;
                    }
                    layer.msg("撤销失败！",{icon:2});
                    return true;
                })
            });
        } else if(obj.event === 'edit'){
            var index = layui.layer.open({
                title : "修改活动",
                type : 2,
                content : "index.php?r=activity/update&id="+data.id,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回活动列表', '.layui-layer-setwin .layui-layer-close', {
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
        } else if(obj.event === 'activity-view'){
            var index = layui.layer.open({
                title : "活动详情",
                type : 2,
                content : "index.php?r=activity/activity-view&id="+data.id,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回活动列表', '.layui-layer-setwin .layui-layer-close', {
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
        }else if(obj.event === 'partake-view'){
            var index = layui.layer.open({
                title : "参与详情",
                type : 2,
                content : "index.php?r=activity/partake-view&id="+data.id,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回活动列表', '.layui-layer-setwin .layui-layer-close', {
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
    var $ = layui.$, active = {
        getCheckData: function(){ //获取选中数据
            var checkStatus = table.checkStatus('activityListTable')
                ,data = checkStatus.data;
            if(data.length === 0){
                return layer.msg('至少选择一个',{icon:2})
            }
            var ids = '';
            var i = 0;
            for(i=0;i<data.length;i++){
                if(i==0){
                    ids = data[i].id;
                }else{
                    ids = ids+','+data[i].id;
                }
            }
            layer.confirm('活动发布后将显示为活动进行中页面'+'<br />'+'请确定是否发布', {
                btn: ['确定','取消'], //按钮
                title:'批量发布'
            }, function(){
                $.post("/index.php?r=activity/state-operation",{
                    ids:ids,
                    status:1,
                },function(res){
                    res = $.parseJSON(res);
                    if (res.code == 0) {
                        layer.msg("批量发布成功！",{icon:1});
                        //刷新父页面
                        location.reload();
                        return true;
                    }
                    layer.msg("批量发布失败！",{icon:2});
                    return true;
                })
            });
        }
        ,getCheckLength: function(){ //获取选中数目
            var checkStatus = table.checkStatus('activityListTable')
                ,data = checkStatus.data;
            if(data.length === 0){
                return layer.msg('至少选择一个',{icon:2})
            }
            var ids = '';
            var i = 0;
            for(i=0;i<data.length;i++){
                if(i==0){
                    ids = data[i].id;
                }else{
                    ids = ids+','+data[i].id;
                }
            }
            layer.confirm('撤消发布后活动将显示为活动结束页面'+'<br />'+'请确定是否撤消？', {
                btn: ['确定','取消'], //按钮
                title:'撤销发布'
            }, function(){
                $.post("/index.php?r=activity/state-operation",{
                    ids:ids,
                    status:0
                },function(res){
                    res = $.parseJSON(res);
                    if (res.code == 0) {
                        layer.msg("批量撤销成功！",{icon:1});
                        //刷新父页面
                        location.reload();
                        return true;
                    }
                    layer.msg("批量撤销失败！",{icon:2});
                    return true;
                })
            });
        }
        /*,isAll: function(){ //验证是否全选
            var checkStatus = table.checkStatus('idTest');
            layer.msg(checkStatus.isAll ? '全选': '未全选')
        }*/
    };
    $('.quoteBox .batch').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });


})
