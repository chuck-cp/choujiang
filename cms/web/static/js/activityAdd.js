layui.use(['form','layer','upload'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery
        ,upload = layui.upload;

    //添加活动
    form.on("submit(addActivity)",function(data){
        var prize_type=new Array();
        $("#prize-id select option:selected").each(function(i){
            prize_type[i]=$(this).val();
        })
        var formData = data.field;
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.post("/index.php?r=activity/create",{
            data : formData,
            prize_type:prize_type
        },function(res){
            res = $.parseJSON(res);
            if (res.code == 0) {
                top.layer.close(index);
                top.layer.msg("活动添加成功！");
                layer.closeAll("iframe");
                //刷新父页面
                parent.location.reload();
                return true;
            }else if(res.code == 300){
                top.layer.close(index);
                top.layer.msg("活动时间"+res.msg+'已存在，请修改活动时间',{icon:2});
                layer.closeAll("iframe");
                return false;
            }else{
                top.layer.close(index);
                top.layer.msg("活动添加失败！");
                layer.closeAll("iframe");
                return true;
            }
        })
        return false;
    })
    //编辑活动
    form.on("submit(updateActivity)",function(data){
        var id = $('#id').val();
        var prize_type=new Array();
        $("#prize-id select option:selected").each(function(i){
            prize_type[i]=$(this).val();
        })
        var formData = data.field;
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.post("/index.php?r=activity/update&id="+id,{
            data : formData,
            prize_type:prize_type
        },function(res){
            res = $.parseJSON(res);
            if (res.code == 0) {
                top.layer.close(index);
                top.layer.msg("活动修改成功！");
                layer.closeAll("iframe");
                //刷新父页面
                parent.location.reload();
                return true;
            }else if(res.code == 300){
                top.layer.close(index);
                top.layer.msg("活动时间"+res.msg+'已存在，请修改活动时间',{icon:2});
                layer.closeAll("iframe");
                return false;
            }else{
                top.layer.close(index);
                top.layer.msg("活动修改失败！");
                layer.closeAll("iframe");
                return true;
            }
        })
        return false;
    })
    //格式化时间
    function filterTime(val){
        if(val < 10){
            return "0" + val;
        }else{
            return val;
        }
    }
    //定时发布
    var time = new Date();
    var submitTime = time.getFullYear()+'-'+filterTime(time.getMonth()+1)+'-'+filterTime(time.getDate())+' '+filterTime(time.getHours())+':'+filterTime(time.getMinutes())+':'+filterTime(time.getSeconds());

    $('.add-prize').on('click',function () {
        var zid = Number($(this).attr('zid'))+1;
        var imgid = 'img'+zid;
        var prize_imageid = 'prize_image'+zid;
        var maxid = 'max'+zid;
        $(this).attr('zid', zid);
        var adhtml = '';
        adhtml = '<div class="layui-row" id='+maxid+'>\n' +
            '            <div class="layui-form-item layui-row layui-col-xs12">\n' +
            '                <div class="prize">\n' +
            '                    <label class="layui-form-label">奖项名称</label>\n' +
            '                    <div class="layui-input-block">\n' +
            '                        <input type="text" class="layui-input prize_title" name="prize_title[]" lay-verify="required" placeholder="请输入奖项名称" style="width: 180px;">\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="prize">\n' +
            '                    <label class="layui-form-label">获奖人数</label>\n' +
            '                    <div class="layui-input-block">\n' +
            '                        <input type="text" class="layui-input name" name="prize_number[]" lay-verify="required" placeholder="请输入获奖人数" style="width: 180px;">\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="prize">\n' +
            '                    <label class="layui-form-label">奖品</label>\n' +
            '                    <div class="layui-input-block">\n' +
            '                        <input type="text" class="layui-input name"  name="prize_name[]" lay-verify="required" placeholder="请输入奖品" style="width: 180px;">\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="prize">\n' +
            '                    <label class="layui-form-label">奖品类型</label>\n' +
            '                    <div class="layui-input-block">\n' +
            '                        <select name="prize_type[]" lay-verify="required">\n' +
            '                            <option value="1">实物</option>\n' +
            '                            <option value="2">现金</option>\n' +
            '                        </select><div class="add_div layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="实物" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit" style=""><dd lay-value="1" class="layui-this">实物</dd><dd lay-value="2" class="">现金</dd></dl></div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '<div class="prize">\n' +
            '                    <div class="layui-input-block">\n' +
            '                        <div style="float: left;">\n' +
            '                            <button style="margin-top: 20px;" type="button" class="layui-btn layui-btn-sm layui-btn layui-btn-danger del" maxid='+maxid+'  >删除奖项</button>\n' +
            '                            <button style="margin-top: 20px;" type="button" class="layui-btn layui-btn-sm imgs" cid='+zid+' >上传图片</button>\n' +
            '                        </div>\n' +
            '                        <div style="float: left; margin-left: 20px;" class="layui-upload-list">\n' +
            '                            <img width="35%" class="layui-upload-img" id='+imgid+'>\n' +
            '                            <input type="hidden" name="prize_image[]" id='+prize_imageid+'>\n' +
            '                            <p id="demoText"></p>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>';
        $(adhtml).appendTo("#prize-id");
    })

    $("#prize-id").on('click','.prize .layui-input-block .imgs',function(){
        var imgid = $(this).attr('cid');
        layui.layer.open({
            type: 2 //此处以iframe举例
            ,title: '上传图片'
            ,area: ['590px', '460px']
            ,shade: 0
            ,maxmin: true
            ,content: '/index.php?r=activity/upload-img&imgid='+imgid
        });
    })

    $("#prize-id").on('click','.prize .layui-input-block .del',function(){
        var maxid = $(this).attr('maxid');
        $( '#prize-id #'+maxid).remove();
    })

    //删除奖项
    $("#prize-id").on('click','.prize .layui-input-block .del-prize',function(){
        var maxid = $(this).attr('maxid');
        var prize_id = $(this).attr('prize-id');
        if(!prize_id){
            layer.msg("删除失败！",{icon:2});
            return false;
        }
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        $.post("/index.php?r=activity/del-prize",{
            prize_id:prize_id,
        },function(res){
            res = $.parseJSON(res);
            if (res.code == 0) {
                top.layer.close(index);
                layer.msg("删除成功！",{icon:1});
                setTimeout(function(){
                    $( '#prize-id #'+maxid).remove();
                },2000);//刷新父页面
                return false;
            }
            top.layer.close(index);
            layer.msg("删除失败！",{icon:2});
            return true;
        })
        /* layer.confirm('你确定要删除此活动吗', {
             btn: ['确定','取消'], //按钮
             title:'删除活动'
         }, function(){
             var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
             parent.layui.layer.close(index);

         });*/
    })



    $("#prize-id").on('click','.layui-row .add_div',function(){
        $("#prize-id").find('.layui-form-select').removeClass("layui-form-selected");
        $("#prize-id").find('.add_div').removeClass("layui-form-selected");
        $(this).toggleClass("layui-form-selected");
        var add_div = $(this);
        add_div.find('dl dd').click(function () {
           $(this).addClass('layui-this').siblings('dd').removeClass();
           add_div.find('.layui-input').val($(this).text());
           var val_num = $(this).addClass('layui-this').attr('lay-value');
            add_div.siblings('select').find('option').removeAttr("selected");
           add_div.siblings('select').find('option[value = '+val_num+']').attr("selected","selected");
       })
    })
})
