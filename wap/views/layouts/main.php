<?php

use common\tools\Cookie;
use yii\helpers\Html;

list($nonceStr,$timestamp,$signature) = \wap\tools\WeChat::getSignature();
$link = Yii::$app->params['wap_url'].'/?i=' .\wap\models\Activity::getUnderwayActivityId(). '&t=' . \common\tools\System::generatePublicToken(Cookie::get('member_id'). '_)' . Cookie::get('open_id') . date('Ymd')). '&f=' . Cookie::get('member_id') . '&o=' . Cookie::get('open_id');
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
<!--    <title>--><?//= $this->title ?><!--</title>-->
    <link rel="stylesheet" type="text/css" href="/static/css/mui.min.css?v=20190905"/>
    <link rel="stylesheet" type="text/css" href="/static/css/com.css?v=20190905"/>
    <link rel="stylesheet" type="text/css" href="/static/css/index.css?v=20190905"/>
    <script src="//res2.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script src="/static/js/jquery1.7.js?v=20190719" type="text/javascript" charset="utf-8"></script>
    <script src="/static/js/mui.min.js?v=20190719" type="text/javascript" charset="utf-8"></script>
    <script src="/static/js/com.js?v=20190723" type="text/javascript" charset="utf-8"></script>
</head>
<body class="body_bg">
<?= $content ?>
<script>
    function isIos() {
        var ua = navigator.userAgent.toLowerCase();
        if (/iphone|ipad|ipod/.test(ua)) {
            return true;
        }
        return false;
    }
    if (isIos() && window.location.pathname == '/') {
        wx.config({
            debug: false,
            appId: '<?=Yii::$app->params['wx_app_id']?>',
            timestamp: '<?=$timestamp?>',
            nonceStr: '<?=$nonceStr?>',
            signature: '<?=$signature?>',
            jsApiList: [
                'checkJsApi',
                'updateAppMessageShareData',
                'updateTimelineShareData',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
            ]
        });
    } else {
        wx.config({
            debug: false,
            appId: '<?=Yii::$app->params['wx_app_id']?>',
            timestamp: '<?=$timestamp?>',
            nonceStr: '<?=$nonceStr?>',
            signature: '<?=$signature?>',
            jsApiList: [
                'checkJsApi',
                'updateAppMessageShareData',
                'updateTimelineShareData',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
            ]
        });
    }

    //分享接口
    wx.ready(function () {
        wx.updateAppMessageShareData({
            title: '一把一把捞天天抽奖，天天兑奖',
            desc: '问答转发赢大奖，手机现金等你来拿！无门槛提现',
            link: '<?=$link?>',
            imgUrl: 'http://yulongchuanmei-1255626690.file.myqcloud.com/agreement/share_image.jpg',
            trigger: function (res) {},
            success: function (res) {},
            cancel: function (res) {},
            fail: function (res) {
                wx.onMenuShareAppMessage({
                    title: '一把一把捞天天抽奖，天天兑奖',
                    desc: '问答转发赢大奖，手机现金等你来拿！无门槛提现',
                    link: '<?=$link?>',
                    imgUrl: 'http://yulongchuanmei-1255626690.file.myqcloud.com/agreement/share_image.jpg',
                    success: function (res) {},
                    fail: function (res) {alert(JSON.stringify(res));}
                });
            }
        });
        wx.updateTimelineShareData({
            title: '一把一把捞天天抽奖，天天兑奖',
            desc: '问答转发赢大奖，手机现金等你来拿！无门槛提现',
            link: '<?=$link?>',
            imgUrl: 'http://yulongchuanmei-1255626690.file.myqcloud.com/agreement/share_image.jpg',
            trigger: function (res) {},
            success: function (res) {},
            cancel: function (res) {},
            fail: function (res) {
                wx.onMenuShareTimeline({
                    title: '一把一把捞天天抽奖，天天兑奖',
                    desc: '问答转发赢大奖，手机现金等你来拿！无门槛提现',
                    link: '<?=$link?>',
                    imgUrl: 'http://yulongchuanmei-1255626690.file.myqcloud.com/agreement/share_image.jpg',
                    success: function (res) {},
                    fail: function (res) {alert(JSON.stringify(res));}
                });
            }
        });
    });
</script>
<div class="weixin_box" style="position: fixed;left: 0;top: 0;right: 0;bottom: 0;background: rgba(0,0,0,.8);z-index: 999;display: none;">
    <div class="" style="width: 77%;margin: 0 auto; padding-top: 38%;position: relative;">
        <p style="text-align: center;margin-bottom: 0;    position: relative;"><img style="width: 50%;" src="/static/img/share_arrow.png" ><img style="width: 32%; position: absolute; top: -56%; right: 10%; z-index: -1;" src="/static/img/share_arrow_link.png" ></p>
        <p style="text-align: center;color: #fed158;width: 85%;margin: 0 auto;">先答题，再转发，才能获得抽奖码！<br>答题后，点击右上角分享好友可以获得更多抽奖码哦！！</p>
    </div>
</div>
<script type="text/javascript">
    $('.share').click(function () {
        var result = {"action":"share", 'title':"一把一把捞天天抽奖，天天兑奖","desc":"问答转发赢大奖，手机现金等你来拿！无门槛提现","link":"<?=$link?>","image":"http://yulongchuanmei-1255626690.file.myqcloud.com/agreement/share_image.jpg"}
        var ua = navigator.userAgent.toLowerCase();
        if (/micromessenger/.test(ua)) {
            $('.weixin_box').show();
        } else if (/iphone|ipad|ipod/.test(ua)) {
            webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
        }else if(/android/.test(ua)) {
            window.jsObj.HtmlcallJava(JSON.stringify(result));
        }
    });
    $('.weixin_box').click(function () {
        $('.weixin_box').hide();
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
