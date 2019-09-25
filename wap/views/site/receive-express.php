<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>奖品寄送进度查询</title>
    <link rel="stylesheet" type="text/css" href="/static/css/mui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/com.css" />
    <style type="text/css">
        .body_bg{ background: #ffffff; }
        .top_box{ text-align: center; }
        .img_bg{ width: 38%; margin-top: 24%; margin-bottom: 6%; }
        .wl_kd{ margin-top: 10%;}
        .wl_kd p{ color: #323232; font-size: 15px; width: 90%; margin: 0 auto; margin-bottom: 4%; }
        .ul_wl{ margin: 0 auto; padding: 0; width: 90%; }
        .ul_wl li{ margin-bottom: 2%; }
        .ul_wl p{ margin: 0; padding-left: 8%; width: 100%; }
        .ul_wl i{ display: inline-block; float: left; height: 10px; width: 10px; color: #000; background: #cccccc; border-radius: 10px; margin-top: 2%; }
        i.i_cur{ background: #ff8800; }
    </style>
</head>
<body class="body_bg">
<!-- 头部导航 -->
<div class="" style="position: relative;">
    <div class="header" style="position: absolute;width: 100%;top: 0; z-index: 1; padding-top: 10px; padding-left: 2px;">
        <div class="layout mui-clearfix">
            <a class="mui-icon mui-icon-left-nav mui-pull-left" style="color: #cccccc;" href="<?=\yii\helpers\Url::to(['site/prize'])?>"></a>
            <h1 class="" style="color: #323232;font-size: 17px;text-align: center;font-weight: normal;">奖品寄送进度查询</h1>
        </div>
    </div>
</div>
<?if (empty($content['express_name'])):?>
    <div class="top_box">
        <img class="img_bg" src="/static/img/icon_hc.png" >
            <p style="color: #999999;width: 80%; margin: 0 auto;">您的奖品暂未发货，如您有任何问题，可拨打我们的客服电话：<span style="color: #ff8800;"><?=$content['customer_service_telephone']?></span></p>
    </div>
<?else:?>
    <div class="top_box">
        <img class="img_bg" src="/static/img/icon_hc.png" >
        <p style="color: #999999;width: 80%; margin: 0 auto;">您的奖品已发货，物流信息如下</p>
    </div>
    <div class="wl_kd">
        <p style="">物流/快递名称<span style="float: right; color: #999999; font-size: 14px;"><?=$content['express_name']?></span></p>
        <p style="">物流/快递编号<span style="float: right; color: #999999; font-size: 14px;"><?=$content['express_number']?></span></p>
        <p style="">物流/快递跟踪</p>
        <ul class="ul_wl">
            <?foreach ($content['express_data'] as $value):?>
            <li>
                <i class="i_cur"></i>
                <p><?=$value['context']?></p>
                <p style=" color: #999999; font-size: 14px;"><?=$value['time']?></p>
            </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif?>
</body>
</html>
<script src="/static/js/jquery1.7.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    mui('body').on('tap','a',function(){
        window.top.location.href = this.href;
    });
</script>