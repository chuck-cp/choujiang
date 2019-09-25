layui.use(['form','layer'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery;
    form.on("submit(updateConfig)",function(data){
        var formData = data.field;
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.post("/index.php?r=activity-config/index",{
            data : formData
        },function(res){
            res = $.parseJSON(res);
            if (res.code == 0) {
                top.layer.close(index);
                top.layer.msg("提交成功！");
                layer.closeAll("iframe");
                //刷新父页面
                return true;
            }
            top.layer.close(index);
            top.layer.msg("提交失败！");
            layer.closeAll("iframe");
            return true;
        })
        return false;
    })
})