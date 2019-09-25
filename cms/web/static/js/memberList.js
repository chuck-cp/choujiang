layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;

    //用户列表
    var tableIns = table.render({
        elem: '#memberList',
        url : 'index.php?r=member/index',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [10,15,20,25],
        limit : 20,
        id : "memberListTable",
        cols : [[
            //{type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:80, align:"center"},
            {field: 'mobile', title: '参与人用户名', minWidth:200, align:"center"},
            {field: 'activity_number', title: '参与活动数', minWidth:200, align:'center'},
            {field: 'draw_number', title: '获奖码数量', minWidth:200, align:'center'},
            {field: 'from', title: '首次参与来源',width:200, align:'center',templet:function(d){
                if(d.from == "1"){
                    return "APP";
                }else if(d.from == "2"){
                    return "微信公众号";
                }
            }},
            {field: 'status', title: '参与状态',width:200, align:'center',templet:function(d){
                if(d.status == "1"){
                    return "正常";
                }else if(d.status == "2"){
                    return "无资格";
                }
            }},
            {title: '操作', Width:100, fixed:"right",align:"center",templet:function(d){
                if(d.status == "1"){
                    return"        <a class=\"layui-btn layui-btn-xs layui-btn-danger\" lay-event=\"cancel\">取消资格</a>\n" +
                        "        <a class=\"layui-btn layui-btn-xs layui-btn-warm\" lay-event=\"qua-view\">资格详情</a>\n" +
                        "        <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"member-view\">查看详情</a>";
                }else if(d.status == "2"){
                    return "<a class=\"layui-btn layui-btn-xs layui-form-onswitch\" lay-event=\"recovery\">恢复资格</a>\n" +
                        "        <a class=\"layui-btn layui-btn-xs layui-btn-warm\" lay-event=\"qua-view\">资格详情</a>\n" +
                        "        <a class=\"layui-btn layui-btn-xs layui-btn-primary\" lay-event=\"member-view\">查看详情</a>";
                }
            }},
        ]]
    });

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        if($(".mobile").val() != '' || $('#from option:selected').val() !='选择参与来源' || $('#status option:selected').val() !='选择参与状态'){
            table.reload("memberListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    mobile: $(".mobile").val(),
                    from: $('#from option:selected').val(),
                    status: $('#status option:selected').val(),
                }
            })
        }else{
            layer.msg("请输入搜索的内容");
        }
    });

    //积分操作
    function integral(id) {
        var index = layui.layer.open({
            title : "积分操作",
            type : 2,
            content : "index.php?r=member/integral&id="+id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
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
    //添加用户
    function addUser(){
        var index = layui.layer.open({
            title : "添加用户",
            type : 2,
            content : "index.php?r=member/create",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
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
    //修改用户
    function updateUser(id){
        var index = layui.layer.open({
            title : "修改用户",
            type : 2,
            content : "index.php?r=member/update&id="+id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
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
    $(".addNews_btn").click(function(){
        addUser();
    })


    function cancel($id){
        layer.open({
            type: 1 //此处以iframe举例
            ,title: '取消资格'
            ,area: ['500px', '270px']
            ,shade: 0
            ,content: '<div class="layui-form-item" style="margin-top: 30px">\n' +
            '        <label class="layui-form-label">取消原因</label>\n' +
            '        <div class="layui-input-block">\n' +
            '            <textarea placeholder="请填写取消资格原因"  style="width: 300px;" class="layui-textarea abstract cancel-add"></textarea>\n' +
            '        </div>\n' +
            '    </div>'
            ,btn: ['确定','取消'] //只是为了演示
            ,yes: function(index,layero){
                var reason = layero.find('textarea')[0].value;
                if(!reason){
                    layer.msg('请填写取消资格原因！',{icon:2});
                    return false;
                }
                $.post("/index.php?r=member/operation-status",{
                    reason:reason,
                    member_id:$id,
                    status:2,
                },function(res){
                    res = $.parseJSON(res);
                    if (res.code == 0) {
                        layer.closeAll();
                        layer.msg("操作成功！",{icon:1});
                        setTimeout(function(){
                            location.reload();
                        },2000);//刷新父页面
                        return true;
                    }
                    layer.msg("操作失败！",{icon:2});
                    return true;
                })
            }
        });
    }
    //监听工具条
    table.on('tool(memberList)', function(obj){
        var data = obj.data;
        if(obj.event === 'cancel'){
            cancel(data.id);
        } else if(obj.event === 'recovery'){
            layer.open({
                 type: 1 //此处以iframe举例
                ,title: '恢复资格'
                ,area: ['500px', '270px']
                ,shade: 0
                ,content: '<div class="layui-form-item" style="margin-top: 30px">\n' +
                '        <label class="layui-form-label">恢复原因</label>\n' +
                '        <div class="layui-input-block">\n' +
                '            <textarea placeholder="请填写恢复资格原因"  style="width: 300px;" class="layui-textarea abstract cancel-add"></textarea>\n' +
                '        </div>\n' +
                '    </div>'
                ,btn: ['确定','取消'] //只是为了演示
                ,yes: function(index,layero){
                    var reason = layero.find('textarea')[0].value;
                    if(!reason){
                        layer.msg('请填写恢复资格原因！',{icon:2});
                        return false;
                    }
                    $.post("/index.php?r=member/operation-status",{
                        reason:reason,
                        member_id:data.id,
                        status:1,
                    },function(res){
                        res = $.parseJSON(res);
                        if (res.code == 0) {
                            layer.closeAll();
                            layer.msg("操作成功！",{icon:1});
                            setTimeout(function(){
                                location.reload();
                            },2000);//刷新父页面
                            return true;
                        }
                        layer.msg("操作失败！",{icon:2});
                        return true;
                    })
                }
            });
        } else if(obj.event === 'qua-view'){
            layer.open({
                type: 2
                ,title: false
                ,area: ['800px', '470px']
                ,shade: 0,
                content: '/index.php?r=member/qua-view&member_id='+data.id
            });
        }else if(obj.event === 'member-view'){
            var index = layui.layer.open({
                title : "查看详情",
                type : 2,
                content : "index.php?r=member/member-view&member_id="+data.id,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回参与人列表', '.layui-layer-setwin .layui-layer-close', {
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
