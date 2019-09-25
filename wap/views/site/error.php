<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>转发抽奖</title>
</head>
<body class="body_bg">
<?
$errorMessage = '出错了!';
$error = Yii::$app->errorHandler->exception;
if ($error) {
    if ($error->getMessage() == 'WEB_OPEN' || $error->getMessage() == '请在APP或微信端打开' || $error->getMessage() == '链接已失效') {
        $errorMessage = $error->getMessage();
    }
}

?>
<?if ($errorMessage == 'WEB_OPEN'):?>
    <style>
        body{font-family: "microsoft yahei" ;max-width: 750px;margin: 0 auto;}
        i{font-style: normal;}
        ul{list-style: none;}
        .body_bg{ background: #bc4038;}
        .img_bg{ width: 100%; display: block;}
        .top_box{ border: 0.75rem solid #fec245; width: 84%; margin: 0 auto; border-radius: 1rem; background: #fff9e9; margin-top: -26px; z-index: 9999; position: relative; margin-bottom: 2rem;}
        .nr_cont{ padding: 1rem; }
        .title_1{ background: linear-gradient(to top, #fd654d , #fec645); display: inline-block; padding: 0.45rem 1rem; border-radius: 4rem; color: #fff; font-size: 1rem; margin: 0; }
    </style>
    <div class="" style="position: relative;">
        <img class="img_bg" src="/static/img/luck_banner.png"/>
    </div>
    <div class="top_box">
        <div class="nr_cont">
            <h2 class="title_1">活动时间</h2>
            <p style="color: #666666;">开始时间为<span style="color: #d14e00;">2019年9月1日</span>，以<span style="color: #d14e00;">15天</span>为一期，一直延续，截止时间待定。</p>
            <h2 class="title_1">参与方式</h2>
            <p style="color: #666666;">在微信中搜索并关注<span style="color: #d14e00;">一把一把捞网公众号</span>，进入公众号点击<span style="color: #d14e00;">天天抽奖</span>参与活动赢大奖。</p>
            <img class="img_bg" src="/static/img//img_p.png"/>
        </div>
    </div>
<?else:?>
    <style type="text/css">
        .body_bg{background-color: #ffffff;}
        a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left{ color: #ccc; }
        .mui-bar-nav{ border: 0; box-shadow: none; }
        .nr_sub{ background: #fff; }
        .img_icon{ padding: 8%; padding-top: 4%; text-align: center;  }
        .img_icon img{ width: 32%; margin-bottom: 18px; }
        .img_icon p{ font-size: 14px; color: #999999; text-align: left; }
        .numb{ background: #fff; padding: 3%; display: inline-block; width: 100%; }
        .nr_numb{ margin-bottom: 26px; }
        .left_p{ float: left; color: #323232; font-size: 14px; }
        .right_p{ float: right; }
        .right_p p{ color: #999999; font-size: 12px; }
        .button_div{ text-align: center; }
        .button_div button{ border-radius: 20px; background: #ff8800; padding: 2% 20%; margin-top: 8%; font-size: 16px; }
        .win_btn{width: 83%; height: 48px;line-height: 48px; background: #ff8800; border: 0; border-radius: 48px; color: #ffffff; font-size: 16px;display: inline-block;}
        a:active{color: #ffffff;}
        .mui-content{background: #FFFFFF;}
    </style>
    <div class="mui-content">
        <div class="nr_sub">
            <div class="img_icon">
                <img src="/static/img/award_end.png">
                <p style="text-align: center;width: 59%; margin: 0 auto;"><?=$errorMessage?></p>
            </div>
        </div>
    </div>

<?endif?>
<br>
<br>
</body></html>