layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;

    //问题列表
    var tableIns = table.render({
        elem: '#activityQuestionList',
        url : 'index.php?r=activity-question/index',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [10,15,20,25],
        limit : 20,
        id : "activityQuestionListTable",
        cols : [[
            //{type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:80, align:"center"},
            {field: 'title', title: '问题标题', minWidth:200, align:"center"},
            {field: 'description', title: '问题描叙', minWidth:200, align:"center"},
            {field: 'correct_answer', title: '正确答案', minWidth:200, align:'center'},
            {field: 'select_type', title: '单选/多选', minWidth:200, align:'center',templet:function (d) {
                if(d.select_type == 1){
                    return "单选";
                }else{
                    return "多选";
                }
            }},
            {field: 'prize_code_number', title: '获得中奖码数量', minWidth:200, align:'center'},
            {field: 'is_activity', title: '活动页显示', minWidth:200, align:'center',templet:function (d) {
                if(d.is_activity == 1){
                    return "显示";
                }else{
                    return "不显示";
                }
            }},
            {field: 'is_prize', title: '领奖品页显示', minWidth:200, align:'center',templet:function (d) {
                if(d.is_prize == 1){
                    return "显示";
                }else{
                    return "不显示";
                }
            }},
            {title: '操作', width:170, align:'center',templet:function(d){
                return "<a class=\"layui-btn layui-btn-xs\" lay-event=\"edit\">修改</a>";
            }},
        ]]
    });

    // //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    // $(".search_btn").on("click",function(){
    //     if($(".mobile").val() != '' || $('#from option:selected').val() !='选择参与来源' || $('#status option:selected').val() !='选择参与状态'){
    //         table.reload("activityQuestionListTable",{
    //             page: {
    //                 curr: 1 //重新从第 1 页开始
    //             },
    //             where: {
    //                 mobile: $(".mobile").val(),
    //                 from: $('#from option:selected').val(),
    //                 status: $('#status option:selected').val(),
    //             }
    //         })
    //     }else{
    //         layer.msg("请输入搜索的内容");
    //     }
    // });

    //添加问题
    function addProblem(){
        var index = layui.layer.open({
            title : "新增问题",
            type : 2,
            content : "index.php?r=activity-question/create",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回问题列表', '.layui-layer-setwin .layui-layer-close', {
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
        });
    }
    $('.problem').click(function () {
        addProblem();
    })

    //监听工具条
    table.on('tool(activityQuestionList)', function(obj){
        var data = obj.data;
        if(obj.event === 'edit'){
            var index = layui.layer.open({
                title : "修改问题",
                type : 2,
                content : "index.php?r=activity-question/update&id="+data.id,
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
