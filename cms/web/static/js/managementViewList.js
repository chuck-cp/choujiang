layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    var cid = $('#cid').val();
    //用户列表
    var tableIns = table.render({
        elem: '#managementViewList',
     //   toolbar: 'default',
        url : 'index.php?r=activity/management-view&cid='+cid,
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [20,50,100],
        limit : 20,
        id : "managementViewListTable",
        cols : [[
            {field: 'id', title: 'ID', width:80, align:"center"},
            {field: 'member_name', title: '获奖人用户名', width:130, align:"center"},
            {field: 'prize_title', title: '所获奖项', width:100, align:'center'},
            {field: 'prize_name', title: '奖品名称', width:100, align:'center'},
            {field: 'receive_member_name', title: '获奖人真实姓名', width:130, align:'center'},
            {field: 'receive_identity_number', title: '身份证号', width:200, align:'center'},
            {field: 'receive_member_mobile', title: '手机号', width:150, align:'center'},
            {field: 'prize_code', title: '获奖码', width:100, align:'center'},
            {field: 'receive_address', title: '收奖地址', minWidth:250, align:'center'},
            {field: 'receive', title: '领奖状态', width:100, align:'center',templet:function(d){
                    if(d.receive == "0"){
                        return "未领取";
                    }else if(d.receive == "1"){
                        return "已领取";
                    }
                }},
            {title: '操作', width:100, align:'center',templet:function(d){
                if(d.receive == "0"){
                    return "——";
                }else if(d.receive == "1"){
                    if(d.prize_type == "1"){
                        if(d.express_name !== ""){
                            return d.express_name +':'+ d.express_number;
                        }else{
                            return "<a class=\"layui-btn layui-btn-xs\" lay-event=\"award\">发奖</a>\n";
                        }
                    }else{
                        return d.express_number;
                    }
                }
            }},
        ]],
    });
    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        table.reload("managementViewListTable",{
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                member_name: $(".member_name").val(),
                prize_title: $(".prize_title").val(),
                prize_code: $('.prize_code').val(),
            }
        })
    });

    //监听工具条
    table.on('tool(managementViewList)', function(obj){
        var data = obj.data;
        if(obj.event === 'award'){
            layer.open({
                type: 1 //此处以iframe举例
                ,title: '发奖'
                ,area: ['500px', '270px']
                ,shade: 0
                ,content: '<div class="layui-form-item" style="margin-top: 30px">\n' +
                        '  <label class="layui-form-label">快递公司</label>\n' +
                        '  <select name="express_name" id="express_name" class="layui-input express_name" style="width: 200px;">\n' +
                        '    <option value="">请选择快递公司</option>\n' +
                        '    <option value="韵达快递">韵达快递</option>\n' +
                        '    <option value="申通快递">申通快递</option>\n' +
                        '    <option value="圆通速递">圆通速递</option>\n' +
                        '    <option value="邮政快递包裹">邮政快递包裹</option>\n' +
                        '    <option value="中通快递">中通快递</option>\n' +
                        '    <option value="顺丰速运">顺丰速运</option>\n' +
                        '    <option value="百世快递">百世快递</option>\n' +
                        '    <option value="京东物流">京东物流</option>\n' +
                        '    <option value="天天快递">天天快递</option>\n' +
                        '    <option value="EMS">EMS</option>\n' +
                        '    <option value="德邦">德邦</option>\n' +
                        '  </select>\n' +
                        '  <label class="layui-form-label">快递单号</label>\n' +
                        '  <input type="text" name="express_number" id="express_number" value="" placeholder="快递单号:123456789" class="layui-input express_number" style="width: 200px;">\n' +
                        '  </div>'
                ,btn: ['确定','取消'] //只是为了演示
                ,yes: function(index,layero){
                    var express_name = layero.find('#express_name').val();
                    var express_number = layero.find('#express_number').val();
                    if(!express_name || !express_number){
                        layer.msg('请填写快递信息！',{icon:2});
                        return false;
                    }
                    $.post("/index.php?r=activity/award",{
                        id:data.id,
                        express_name:express_name,
                        express_number:express_number,
                    },function(res){
                        res = $.parseJSON(res);
                        if (res.code == 1) {
                            layer.closeAll();
                            layer.msg(res.msg,{icon:1});
                            setTimeout(function(){
                                location.reload();
                            },2000);//刷新父页面
                            return true;
                        }
                        layer.msg(res.msg,{icon:2});
                        return true;
                    })
                }
            });
        }
    });
})
