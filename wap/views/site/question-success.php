<?$this->title = "提交成功"; ?>
<style type="text/css">
    .body_bg{background-color: #efeff4;}
    a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left{ color: #ccc; }
    .mui-bar-nav{ border: 0; box-shadow: none; }
    .nr_sub{ background: #fff; }
    .img_icon{ padding: 8%; padding-top: 4%; text-align: center; border-bottom: 1px solid #f0f0f0; }
    .img_icon img{ width: 68%; margin-bottom: 18px; }
    .img_icon p{ font-size: 14px; color: #999999; text-align: left; }
    .numb{ background: #fff; padding: 3%; display: inline-block; width: 100%; }
    .nr_numb{ margin-bottom: 26px; }
    .left_p{ float: left; color: #323232; font-size: 14px; }
    .right_p{ float: right; }
    .right_p p{ color: #999999; font-size: 12px; }
    .button_div{ text-align: center; }
    .button_div button{ border-radius: 20px; background: #ff8800; padding: 2% 20%; margin-top: 8%; font-size: 16px; }
    button.btn_hs{ background: #ccc; margin-bottom: 10%; border: 0; margin-top: 6%; }
</style>
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?=\yii\helpers\Url::to(['/','i' => $i])?>"></a>
    <h1 class="mui-title"></h1>
</header>
<div class="mui-content">
    <div class="nr_sub">
        <div class="img_icon">
            <img src="/static/img/icon_suc.png">
            <p>将此活动分享转发微信好友或朋友圈可以赢得更多抽奖码。每有一个好友打开你的转发链接，你即可多获得1个抽奖码（此转发环节最多可获得8个抽奖码），分享大大增加中奖机会哦！快去转发吧！每天9:00开奖，记得常回来看看哦！</p>
        </div>
    </div>
    <div class="numb">
        <div class="nr_numb">
            <p class="left_p">您获得的抽奖码为</p>
            <div class="right_p">
                <?foreach ($data as $value):?>
                <p> <?=$value?> </p>
                <?endforeach;?>
            </div>
        </div>
    </div>
    <div class="button_div">
        <button type="button" class="mui-btn mui-btn-warning share">
            分享给好友获取更多抽奖码
        </button>
        <button type="button" class="mui-btn mui-btn-warning" style="background: none; border: none; color: #ff8800; padding: 0; font-size: 14px;">
            好友打开=抽奖码=中奖概率COUCOU提升
        </button>
    </div>
</div>

<script>
    mui('body').on('tap','a',function(){
        window.top.location.href = this.href;
    });
</script>