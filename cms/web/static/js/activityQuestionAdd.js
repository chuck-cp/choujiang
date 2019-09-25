layui.use(['form','layer'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery;
    //新增
    form.on("submit(addquestion)",function(data){
        var formData = data.field;
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.post("/index.php?r=activity-question/create-add",{
            data : formData,
        },function(res){
            res = $.parseJSON(res);
            if (res.code == 1) {
                top.layer.close(index);
                top.layer.msg(res.msg );
                layer.closeAll("iframe");
                //刷新父页面
                parent.location.reload();
                return true;
            }
            top.layer.close(index);
            top.layer.msg(res.msg);
            layer.closeAll("iframe");
            return true;
        })
        return false;
    })
    //修改
    form.on("submit(editquestion)",function(data){
        var formData = data.field;
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.post("/index.php?r=activity-question/update-add",{
            data : formData,
        },function(resd){
            resd = $.parseJSON(resd);
            if (resd.code == 1) {
                top.layer.close(index);
                top.layer.msg(resd.msg );
                layer.closeAll("iframe");
                //刷新父页面
                parent.location.reload();
                return true;
            }
            top.layer.close(index);
            top.layer.msg(resd.msg);
            layer.closeAll("iframe");
            return true;
        })
        return false;
    })

})