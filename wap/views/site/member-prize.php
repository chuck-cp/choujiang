<?

use common\tools\Cookie;

$this->title = "我的奖品"
?>
<style type="text/css">
    .body_bg{ background: #f0f0f0; }
    .cont_hd{ background: #ffffff; padding: 4%; margin-top: 14px; }
    .cont_hd p{ color: #323232; font-size: 15px; margin: 0 auto; margin-bottom: 4%; }
    .re_cord{  }
    .li_left{ float: left; }
    .mui-btn{ float: right; color: #ccc; background: #fff; border-color: #ccc; border-radius: 20px; margin-top: 1%; }
    p.nu_font{ font-size: 14px; }
    p.time_p{ color: #cccccc; }
    .btn_prize{ background: #ff8800; color: #fff; border-color: #ff8800; width: auto; padding: 6px 10px; font-size: 14px; }
    .zj_img{ background: #f3f3f3; padding: 3%; font-size: 16px; padding-bottom: 2%; }
    .mui-popover-arrow{ display: none; }
    .mui-backdrop{ background-color: rgba(0,0,0,.7); }
    div#popover{ position: fixed; top: 26% !important; background: none; width: 100%; left: 0 !important; text-align: center; }
    .wz_p p{ color: #323232; text-align: left; margin: 0; }
    .bottom_p{ position: absolute; top: 87%; width: 90%; left: 5%; }
    .bottom_p a{ color: #fff; }
    p{color: #FFFFFF;font-size: 14px;font-family: "microsoft yahei";}
    img{margin-left: 4px;margin-right: 4px;vertical-align: middle;}

</style>
<!-- 头部导航 -->
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-icon mui-icon-left-nav mui-pull-left" style="color: #cccccc;" href="<?=\yii\helpers\Url::to(['site/code'])?>"></a>
    <h1 class="mui-title">我的奖品</h1>
</header>
<!-- 头部导航 -->
<div class="mui-content">
    <?foreach ($content as $value): if ($value['prize_date'] == date('Y-m-d') && \common\tools\System::convertPrizeTime($value['prize_time'],2) > date('H')) continue?>
    <div class="cont_hd">
        <p style="">活动名称<span style="float: right; color: #999999; font-size: 14px;"><?=$value['activity_title']?></span></p>
        <p style="">开奖时间<span style="float: right; color: #999999; font-size: 14px;"><?=$value['prize_date'] . ' ' . \common\tools\System::convertPrizeTime($value['prize_time'])?> </span></p>
        <div class="re_cord">
            <div style="display: inline-block; width: 100%;">
                <div class="li_left">
                    <p class="nu_font"><?=$value['prize_code']?></p>
                    <p class="time_p"><?=$value['prize_code_date']?></p>
                </div>
                <?if ($value['receive'] == 1):?>
                    <a href="<?= Cookie::get('from') == 'APP' ?  \yii\helpers\Url::to(['site/receive-express','roster_id' => $value['id']]) : '#popover'?>" class="mui-btn mui-btn-primary mui-btn-block btn_prize"><?=\common\tools\System::getMemberPrizeTitle($value['prize_type'])?></a>
                <?else:?>
                    <a href="<?= Cookie::get('from') == 'APP' ? \yii\helpers\Url::to(['site/receive-question','roster_id' => $value['id']]) : '#popover'?>" id="openPopover" class="mui-btn mui-btn-primary mui-btn-block btn_prize">领取奖品</a>
                <?endif?>
            </div>
            <div class="zj_img">
                <img src="<?=$value['prize_image']?>" style="width: 30%; min-height: 14.5vh;">
                <div style="width: 66%; float: right; margin-top: 8%;"><?=$value['prize_title']?><p style=" color: #999999; font-size: 14px;"><?=$value['prize_name']?><?=$value['prize_type'] == \common\tools\Globle::PRIZE_INVENT ? "元现金" : ''?></p></div>
            </div>
        </div>
    </div>
    <?endforeach;?>
    <div id="popover" class="mui-popover">
        <div style="position: relative;">
            <img src="/static/img/popup_tc.png" style="width: 90%;">
            <div class="wz_p" style="position: absolute; top: 20%; width: 80%; left: 9%;">
                <p>领取奖品需在一把一把捞APP内领取</p>
                <br/>
                <p>如您还未下载一把一把捞APP，请您点击“下载APP”去下载并领取奖品</p>
                <br/>
                <p>如您已下载一把一把捞APP，请您点击“打开APP”去领取奖品。</p>
            </div>
            <div class="bottom_p">
                <p style="float: left; width: 50%; text-align: center; color: #fff;" class="down_app">下载APP</p>
                <p style="float: right; width: 50%; text-align: center; color: #fff;" class="down_app">打开APP</p>
                </p>
            </div>
        </div>
    </div>
    <!-- 微信下载提示弹框 -->
    <div class="weixin_box2" style="position: fixed;left: 0;top: 0;right: 0;bottom: 0;background: rgba(0,0,0,.8);z-index: 999;display: none;">
        <div class="" style="width: 77%;margin: 0 auto; padding-top: 20%;position: relative;">
            <p style="width: 74%;">检测出您使用的是微信，微信暂不支持打开或下载APP</p>
            <p>1、点击右上角的<img style="width: 20px;" src="/static/img/more_open.png" >按钮</p>
            <p>2、选择<img style="width: 94px;" src="/static/img/www_open.png" ></p>
            <img style="width: 34%;position: absolute;right: 0;top: 44%;" src="/static/img/weixin_arrow.png" >
        </div>
    </div>
    <script>
    $('.down_app').click(function () {
        $('.weixin_box2').show();
    });
    $('.weixin_box2').click(function () {
        $('.weixin_box2').hide();
    });

    mui('body').on('tap','a',function(){
        window.top.location.href = this.href;
    });
</script>