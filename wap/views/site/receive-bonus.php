<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>领取奖品现金</title>
    <link rel="stylesheet" type="text/css" href="/static/css/mui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/com.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/index.css" />
    <style type="text/css">
        body{color: #323232;}
        a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left{ color: #ccc; }
        .mui-bar-nav{ border: 0; box-shadow: none; }
        .win_btn{width: 83%; height: 48px; background: #ff8800; border: 0; border-radius: 48px; color: #ffffff; font-size: 16px;}
        button:enabled:active{background: #ff8800;}
        /* 领取奖品 */
        .mui-content{background: #FFFFFF;}
        .explain{width: 71%;margin: 0 auto;}
        .explain p{color: #999999;}
        .cash_bao{width: 84%;}
        .cash_box{text-align: center;position: relative;margin-top: 4%;}
        .cash_con{position: absolute;top: 0;padding-left: 18%; padding-right: 18%;    padding-top: 7%;}
        .cash_btn{width: 86%;cursor: pointer;}
        .cash_tt{color: #90552b;font-size: 16px;}
        .shop_cash{color: #e6423d;font-weight: bold;font-size: 16px;margin-top: 5%; margin-bottom: 7%;}
        .shop_cash i{font-size: 12px; color: #cd8f5a; border: 1px solid #cd8f5a; font-weight: normal; width: 1.4rem; display: inline-block; line-height: 1; padding: 2px;}
        .shop_cash b{font-size: 40px;}
        .cash_kuan{ margin: 0 auto;background: url(/static/img/cash_kuan.png) no-repeat ;    background-size: 100% 100%;color: #FFFFFF;height: 32px; line-height: 31px;    margin-bottom: 34%;    width: 202px;}
        .cash_txt{color: #FFFFFF;text-align: left;    margin-bottom: 8%;}
        .btn_close{top: -3rem;cursor: pointer;}
        /* 领取成功弹窗 */
        .win_wrap{position: fixed;left: 0;top: 0;bottom: 0;right: 0;background: rgba(0,0,0,.7);z-index: 99;display: none;}
        .win_ok{width: 77%;margin: 0 auto;background: #FFFFFF;position: relative;margin-top: 50%;    border-radius: 6px;font-size: 12px; }
        .win_img{width: 170px; position: absolute; top: -14px; left: 50%; margin-left: -86px;}
        .index_btn{color: #FFFFFF; font-size: 16px; float: left; height: 40px; width: 50%; background: #ff8800; line-height: 40px; text-align: center; border-radius: 0; border: 0; padding: 0; border-bottom-left-radius: 6px;}
        .look_btn{color: #FFFFFF;font-size: 16px;float: left;height: 40px;width: 50%;background: #ff8800;line-height: 40px; text-align: center;border-radius: 0; border: 0; padding: 0; border-bottom-right-radius: 6px;background: #cccccc;}
        .win_txt{padding-left: 7%; padding-right: 7%; padding-top: 16%; padding-bottom: 12%;}
        @media screen and (max-width: 320px) {
            .cash_kuan{margin-bottom: 22%;}
            .cash_txt{margin-bottom: 4%;}
            .win_img{width: 146px;top: -12px;margin-left: -74px;}
        }

    </style>
</head>
<body style="background: #FFFFFF;">
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?=\yii\helpers\Url::to(['site/prize'])?>"></a>
    <h1 class="mui-title">领取奖品</h1>
</header>
<div class="mui-content">
    <div class="cash_box">
        <img class="cash_bao" src="/static/img/winning_cash.png" >
        <div class="cash_con">
            <p class="cash_tt">恭喜您获得<?=$content['prize_name']?>元现金</p>
            <p class="shop_cash"><i>购物款</i> <b><?=$content['prize_coupon']?></b> 元</p>
            <p class="cash_kuan">折合购物款<?=$content['prize_coupon']?>元</p>
            <p class="cash_txt">您可以直接申请提现或兑换成购物款<i style="color: #ffec1b;"><?=$content['prize_coupon']?>元</i>在一把一把捞平台购物使用，购物款可一次或分次购物抵扣，无任何使用门槛。</p>
            <p><img class="cash_btn" src="/static/img/cash_btn.png" ></p>
        </div>
    </div>
    <br>
    <div class="" style="text-align: center;">
        <button class="win_btn" type="button">现金提现</button>
    </div>
    <br>
    <div class="explain">
        <p>提现途径：一把一把捞APP-我的账户/账户管理</p>
        <p>如您有任何问题可拨打客服电话：<?=\wap\models\ActivityConfig::getConfig('customer_service_telephone')?></p>
    </div>
</div>
<br>
<br>
<br>
<!-- 购物款兑换成功 -->
<div class="win_wrap">
    <div class="win_ok">
        <img class="win_img" src="/static/img/exchange_ok.png">
        <p class="win_txt">购物款兑换成功，您的<?=$content['prize_coupon']?>元购物款已到账！</p>
        <div class="win_btnbox mui-clearfix">
            <button class="index_btn" >去购买商品</button><button class="look_btn">查看购物款</button>
        </div>
    </div>
</div>

<script src="/static/js/jquery1.7.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/com.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $('.look_btn').click(function(){
        var result = {"action":"bonus"};
        var ua = navigator.userAgent.toLowerCase();
        if (/iphone|ipad|ipod/.test(ua)) {
            webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
        }else if(/android/.test(ua)) {
            window.jsObj.HtmlcallJava(JSON.stringify(result));
        }
    });

    $('.index_btn').click(function () {
        var result = {"action":"index"};
        var ua = navigator.userAgent.toLowerCase();
        if (/iphone|ipad|ipod/.test(ua)) {
            webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
        }else if(/android/.test(ua)) {
            window.jsObj.HtmlcallJava(JSON.stringify(result));
        }
    });

    mui('body').on('tap','a',function(){
        window.top.location.href = this.href;
    });

    $('.win_btn').click(function () {
        ajaxGet('<?=\yii\helpers\Url::to(['/site/receive-bonus','roster_id' => $content['id'],'type' => 1])?>',{},function (data) {
            if (data.code == 200) {
                window.location.href = '<?=\yii\helpers\Url::to(['/site/receive-express','roster_id' => $roster_id])?>';
            } else {
                mui.toast(data.message);
            }
        });
    });


    $('.cash_btn').click(function () {
        ajaxGet('<?=\yii\helpers\Url::to(['/site/receive-bonus','roster_id' => $content['id'],'type' => 2])?>',{},function (data) {
            if (data.code == 200) {
                $('.win_wrap').show();
            } else {
                mui.toast(data.message);
            }
        });
    });
</script>
</body>
</html>