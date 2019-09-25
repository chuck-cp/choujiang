layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    var member_id = $('#member_id').val();
    //用户列表
    var tableIns = table.render({
        elem: '#memberViewList',
        url : 'index.php?r=member/member-view&member_id='+member_id,
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [10,15,20,25],
        limit : 20,
        id : "memberViewListTable",
        cols : [[
            {field: 'id', title: 'ID', width:80, align:"center"},
            {field: 'create_at', title: '参与时间', width:200, align:"center"},
            {field: 'activity_title', title: '参与活动名称', width:200, align:'center'},
            {field: 'prize_code', title: '获奖码', width:200, align:'center'},
            {field: 'grant_style', title: '获取方式', width:200, align:'center'},
            {field: 'prize_title', title: '所中奖项', width:150, align:'center'},
        ]]
    });

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        table.reload("memberViewListTable",{
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                activity_title: $(".activity_title").val(),
                prize_code: $(".prize_code").val(),
                prize_title: $('#prize_title option:selected').val(),
            }
        })
    });
})
