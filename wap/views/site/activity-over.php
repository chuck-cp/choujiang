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
</head>
<div class="mui-content">
    <?if (\common\tools\Cookie::get('from') == 'APP'):?>
    <div class="header" style="position: absolute;width: 100%;top: 3%;">
        <div class="layout mui-clearfix">
            <a class="mui-icon mui-icon-left-nav mui-pull-left" style="color: #cccccc;" onclick="openApp()"></a>
        </div>
    </div>
    <?endif?>
    <?if ($activity_id) : ?>
    <div class="nr_sub" style="margin-top: 25%">
        <div class="img_icon">
            <img src="/static/img/award_end.png">
            <p style="text-align: center;width: 59%; margin: 0 auto;">来晚啦，本期活动已结束快去参加我们新一期的活动吧！</p>
        </div>
    </div>
    <br>
    <div class="" style="text-align: center;">
        <a href="<?=\yii\helpers\Url::to(['/','i' => $activity_id])?>" class="win_btn " >去参加</a>
    </div>
        <br>
    <?else:?>
        <div class="nr_sub">
            <div class="img_icon">
                <img src="/static/img/award_end.png">
                <p style="text-align: center;width: 59%; margin: 0 auto;">来晚啦，本期活动已结束！</p>
            </div>
        </div>
    <?endif?>
    <div class="" style="text-align: center;">
        <a href="<?=\yii\helpers\Url::to(['site/code'])?>" class="win_btn right_tt2" >查看我的抽奖码</a>
    </div>
    <!-- 遮罩 -->
    <div class="shade"></div>
    <!-- 登录弹窗 -->
    <div class="login_box">
        <div class="login">
            <img class="img_bg" src="/static/img/login.png" >
            <img class="btn_close" src="/static/img/close.png" >
            <ul class="login_list">
                <li><input type="tel" name="" id="mobi" value="" maxlength="11" placeholder="请输入您的手机号" /><input class="get_code" type="button" value="获取验证码"></li>
                <li><input type="tel" name="" id="code" value="" maxlength="6" placeholder="请输入您的验证码" /></li>
            </ul>
        </div>
    </div>
    <br>
    <br>

<script>
    function openApp() {
        var result = {"action":"index"};
        var ua = navigator.userAgent.toLowerCase();
        if (/iphone|ipad|ipod/.test(ua)) {
            webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
        }else if(/android/.test(ua)) {
            window.jsObj.HtmlcallJava(JSON.stringify(result));
        }
    }
    $('.btn_close').click(function () {
        $('.shade,.login_box').hide();
    });

    $('.right_tt2').click(function () {
        if (getCookie('activity_token') == "") {
            $('.shade,.login_box').show();
            return false;
        }
    });
    $(".get_code").click(function(){
        var mobi_val = $('#mobi').val();
        if (mobi_val == '') {
            mui.toast('请输入您的手机号');
            return false;
        } else if (!(/^1[3456789]\d{9}$/.test(mobi_val))) {
            mui.toast('请输入正确的手机号');
            return false;
        }else{
            get_code(mobi_val);
        }
    });

    $('#code').live('input propertychange',function () {
        // 验证码校验
        var code_val = $('#code').val();
        if ( 6 == code_val.length) {
            var data = {
                'mobile':$('#mobi').val(),
                'verify':$('#code').val()
            };
            ajaxGet("/site/login",data,function(data) {
                mui.toast(data.message);
                if (data.code == 200) {
                    window.location.href = '<?=\yii\helpers\Url::to(['site/code'])?>';
                    $('.shade,.login_box').hide();
                }
            });
        }
    })
</script>