<?$this->title = "转发抽奖"; ?>
<style>
    p{font-size: 14px;}
</style>
<div class="top_box">
    <img class="img_bg" src="/static/img/top_banner.jpg" >
    <div class="header" style="position: absolute;width: 100%;top: 3%;">
        <div class="layout mui-clearfix">
            <?if (\common\tools\Cookie::get('from') == 'APP'):?>
            <a class="mui-icon mui-icon-left-nav mui-pull-left" style="color: #cccccc;" onclick="openApp()"></a>
            <?endif?>
            <a href="javascript:" class="mui-pull-right share" style="padding-top: 4px;padding-right: 2%;font-size: 14px;color: #ffffff"><img style="width: 18px; vertical-align: middle; margin-right: 4px;" src="/static/img/share_btn.png" id="share">转发</a>
        </div>
    </div>
    <div class="luck_box">
        <img class="img_bg" src="/static/img/go_bg.png?v=0820" >
<!--        <p class="wdzf">问答转发<i class="gold">赢大奖</i></p>-->
    </div>
    <div class="right_nav">
        <img class="img_bg" src="/static/img/rule.png" >
        <a href="<?=\yii\helpers\Url::to(['rule'])?>"><span class="right_tt right_tt1">活动规则</span></a>
        <img class="img_bg" src="/static/img/mys.png" >
        <a href="<?=\yii\helpers\Url::to(['code'])?>"><span class="right_tt right_tt2">我的</span></a>
    </div>
</div>
<div class="layout luck_draw">
    <img class="img_bg" src="/static/img/luck_draw.png" >
    <div class="luck_con">
        <label class="luck_tt">
            <b class="draw_tt">每期15天   第1期开始时间：2019-09-01</b>
        </label>
        <ul class="mui-clearfix prize_box">
            <li><img class="img_bg" src="/static/img/one_prize.png" ></li>
            <li><img class="img_bg" src="/static/img/two_prize.png" ></li>
            <li><img class="img_bg" src="/static/img/three_prize.png" ></li>
        </ul>
        <div class="draw_btn_box">
            <?if ($is_answer): ?>
                <a href="<?=\yii\helpers\Url::to(['site/code'])?>"><img class="draw_btn" src="/static/img/view_prize_code.png"></a>
            <?else:?>
                <a href="<?=\yii\helpers\Url::to(['site/question','i' => $activity_id])?>"><b class="draw_btn">去抽奖</b></a>
            <?endif;?>
        </div>
        <div class="prize_list">
            <b class="btn_tt btn_set">奖项设置</b>
            <p><i class="red">一等奖：</i>每天5名，奖品为华为新款手机1部/人</p>
            <p><i class="red">二等奖：</i>每天100名，奖品为现金100元/人</p>
            <p><i class="red">三等奖：</i>每天1000名，奖品为现金10元/人</p>
            <b class="btn_tt btn_ma">开奖时间</b>
            <p class="lottery_time">每天<i class="red"> 09:00 </i>准时开奖</p>
        </div>
    </div>
</div>
<div class="layout participatory">
    <img class="img_bg" src="/static/img/participatory.png" >
    <div class="main">
        <p>用户回答问题，分享转发好友或朋友圈获得抽奖码，一把一把捞会在参与的所有用户中抽取幸运用户，幸运用户可获得一把一把捞设置的一等奖、二等奖、三等奖奖品。<br>重要提示：先答题，再转发，才能获得抽奖码哦</p><br>
    </div>
</div>
<div class="layout lottery_draw">
    <img class="img_bg" src="/static/img/lottery_draw.png" >
    <div class="main">
        <b class="btn_tt" >方法一</b>
        <p class="zqhd">正确回答问题可获得<i class="red">3</i>个抽奖码</p>
        <b class="btn_tt" >方法二</b>
        <p class="zqhd">将此活动转发微信好友或朋友圈，好友打开活动链接，则可获得<i class="red">1</i>个抽奖码，转发最多可获得<i class="red">8</i>个抽奖码</p>
        <p></p>
        <p>天天答题转发，天天抽奖： 每天0:00-24:00答题转发集抽奖码，当天获得的抽奖码次日9:00开奖</p>
    </div>
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

<script type="text/javascript">
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

    $('.draw_btn').click(function () {
        if (getCookie('activity_token') == "") {
            $('.shade,.login_box').show();
            return false;
        }
    });

    $('#share').click(function () {
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
                    if (data.data.is_answer == 1) {
                        $('.draw_btn_box').html('<a href="<?=\yii\helpers\Url::to(['site/code'])?>"><img class="draw_btn" src="/static/img/view_prize_code.png"></a')
                    }
                    $('.shade,.login_box').hide();
                }
            });
        }
    })
</script>

