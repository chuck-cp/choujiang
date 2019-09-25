<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/css/mui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/com.css" />
    <style type="text/css">
        .body_bg{ background: #ffffff; }
        .top_box{ text-align: center; }
        .img_bg{ width: 38%; margin-top: 24%; margin-bottom: 6%; }
        .btn_prize{ color: #fff; background: #ff8800; width: 80%; border-radius: 30px; margin-top: 10%; height: 40px;    border: 0; display: inline-block; line-height: 40px; padding: 0;}
        .btn_hs{ background: #ccc; margin-bottom: 10%; border: 0; margin-top: 6%; }
        a:active{color: #FFFFFF;}
    </style>
</head>
<body class="body_bg">
<!-- 头部导航 -->
<div class="" style="position: relative;">
    <div class="header" style="position: absolute;width: 100%;top: 0; z-index: 1; padding-top: 10px; padding-left: 2px;">
        <div class="layout mui-clearfix">
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #cccccc;"></a>
            <h1 class="" style="color: #323232;font-size: 17px;text-align: center;font-weight: normal;">查看奖品详情</h1>
        </div>
    </div>
</div>

<div class="top_box">
    <img class="img_bg" src="/static/img/icon_hc.png">
    <?if ($content['receive_prize_type'] == 3):?>
        <p style="color: #999999;width: 80%; margin: 0 auto; text-align: left;">您兑换的<?=$content['prize_coupon']?>元购物款已到账，如您有任何问题，可拨打我们的客服电话：<span style="color: #ff8800;"><?=\wap\models\ActivityConfig::getConfig('customer_service_telephone')?></span></p>
        <button type="button" class="mui-btn  btn_prize" onclick="openIndex()">
            去购买商品使用
        </button>
        <button type="button" class="mui-btn  btn_prize btn_hs" onclick="openBonus()">
            查看购物款
        </button>
    <?else:?>
        <p style="color: #999999;width: 80%; margin: 0 auto; text-align: left;">
            您的奖品（<?=$content['prize_name']?>元现金）已发放到您在一把一把捞APP内的的账户中，查询途径：一把一把捞APP-中心-我的账户/账户管理。如您还未申请提现，您可以去”申请提现“将钱提到您的银行卡中。如您有任何问题，可拨打我们的客服电话：<span style="color: #ff8800;"><?=\wap\models\ActivityConfig::getConfig('customer_service_telephone')?></span></p>
        <button type="button" class="mui-btn  btn_prize" onclick="openAccount()">
            就去账户看看
        </button>
    <?endif?>
</div>
<script src="/static/js/jquery1.7.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/com.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>