<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章列表--layui后台管理模板 2.0</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/static/css/public.css" media="all" />
</head>
<body class="childrenBody">
<form  class="layui-form layui-row layui-col-space10">
	<div class="layui-col-md9 layui-col-xs12">
		<div class="layui-row layui-col-space10">
			<div class="layui-col-md3 layui-col-xs5">
				<div class="layui-upload-list thumbBox mag0 magt3">
					<img class="layui-upload-img thumbImg">
				</div>
			</div>
		</div>
	</div>
    <input type="hidden" value="<?=$imgid?>" id='imgid'>
    <img width="35%" class="layui-upload-img" id="aaaaa">
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script>layui.use(['form', 'layer','jquery','upload'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;
            var upload = layui.upload;
            var index = parent.layui.layer.getFrameIndex(window.name); //获取窗口索引

            //普通图片上传
            var imgid =$('#imgid').val();
            //注意：parent 是 JS 自带的全局对象，可用于操作父页面

            var uploadInst = upload.render({
                elem: '.thumbBox',
                url: "/index.php?r=activity/img",
                before: function(obj){
                    obj.preview(function(index, file, result){
                        $('.thumbImg').attr('src', result); //图片链接（base64）
                    });
                },done: function(res){
                    if (res.code === 0) {
                        parent.$('.prize .layui-input-block .layui-upload-list #img<?=$imgid?>').attr('src',res.access_url);
                        parent.$('.prize .layui-input-block .layui-upload-list #prize_image<?=$imgid?>').attr('value',res.access_url);
                        $('.thumbImg').attr('src',res.access_url);
                        parent.layui.layer.close(index);
                    } else {
                        //如果上传失败
                        return layer.msg('上传失败');
                    }
                    //上传成功
                }
            });
        });
</script>
</body>
</html>