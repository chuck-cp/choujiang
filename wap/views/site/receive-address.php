<?$this->title = "领取奖品"?>
<style type="text/css">
    .body_bg{background-color: #ffffff;}
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
    /* 物流信息 */
    .win_btn{width: 83%; height: 48px; background: #ff8800; border: 0; border-radius: 48px; color: #ffffff; font-size: 16px;}
    button:enabled:active{background: #ff8800;}
    .receiving_information{margin: 0;padding: 0;padding-left: 3%; padding-right: 3%;}
    .first_span{display: inline-block;width: 32%;font-size: 13px;}
    .second_span{display: inline-block; width: 68%;font-size: 12px;}
    .second_span input{font-size: 12px;border: 0;padding: 0;margin: 0;width: 100%;}
    .log_info{background: #FFFFFF;margin-top: 20px;}
    .write_tt{font-size: 16px;color: #323232;font-weight: normal;padding: 14px 3%;border-bottom: 1px #F0F0F0 solid;margin-top: 0;}
    .tab_org{width: 4px;background: #ff7d09;font-size: 12px;margin-right: 10px;}

    .win_wrap{position: fixed;left: 0;top: 0;bottom: 0;right: 0;background: rgba(0,0,0,.7);z-index: 99;display: none;}
    .win_ok{width: 77%;margin: 0 auto;background: #FFFFFF;position: relative;margin-top: 50%;    border-radius: 6px;font-size: 12px; }
    .win_img{width: 170px; position: absolute; top: -14px; left: 50%; margin-left: -86px;}
    .index_btn{color: #FFFFFF; font-size: 16px; float: left; height: 40px; width: 50%; background: #ff8800; line-height: 40px; text-align: center; border-radius: 0; border: 0; padding: 0; border-bottom-left-radius: 6px;}
    .look_btn{color: #FFFFFF;font-size: 16px;float: left;height: 40px;width: 50%;background: #ff8800;line-height: 40px; text-align: center;border-bottom-right-radius: 6px;background: #cccccc;}
    .win_txt{padding-left: 7%; padding-right: 7%; padding-top: 16%; padding-bottom: 12%;}
    @media screen and (max-width: 320px) {
        .win_img{width: 146px;top: -12px;margin-left: -74px;}
    }
</style>
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?=\yii\helpers\Url::to(['site/prize'])?>"></a>
    <h1 class="mui-title">领取奖品</h1>
</header>
<div class="mui-content">
    <div class="nr_sub">
        <div class="img_icon">
            <img src="<?=$content['prize_image']?>">
            <p style="text-align: center;">您获得<?=$content['prize_name']?>一部，请填写以下奖品收货信息，以方便我们将奖品快速邮寄给您。</p>
        </div>
    </div>
    <!-- 非手机领取可以隐藏或者删除此信息 -->
    <div class="log_info">
        <h2 class="write_tt"><i class="tab_org">&nbsp;</i><span>填写收货信息</span></h2>
        <ul class="receiving_information mui-clearfix">
            <li><span class="first_span">姓名</span><span class="second_span"><input type="text" name="receive_member_name" id="receive_member_name" value="" placeholder="请填写领奖人姓名"/></span></li>
            <li><span class="first_span">手机号码</span><span class="second_span"><input type="tel" name="receive_member_mobile" id="receive_member_mobile" value="" placeholder="请填写领奖人手机号码"/></span></li>
            <li><span class="first_span">详细地址</span><span class="second_span"><input type="text" name="receive_address" id="receive_address" value="" placeholder="请填写收货地址"/></span></li>
            <li><span class="first_span">领奖人身份证号</span><span class="second_span"><input type="text" name="receive_identity_number" id="receive_identity_number" value="" placeholder="请填写领奖人身份证号"/></span></li>
        </ul>
    </div>
    <!-- 非手机领取可以隐藏或者删除此信息 -->
    <br>
    <div class="" style="text-align: center;">
        <button class="win_btn" type="button">确认领取奖品</button>
    </div>
    <div class="win_wrap">
        <div class="win_ok">
            <img class="win_img" src="/static/img/win_ok.png" >
            <p class="win_txt">我们的工作人员会在1-3个工作日内邮寄您的奖品</p>
            <div class="win_btnbox mui-clearfix">
                <button class="index_btn"  onclick="openIndex()">去首页逛逛</button><a class="look_btn" href="<?=\yii\helpers\Url::to(['site/prize'])?>">查看奖品</a>
            </div>
        </div>
    </div>

    <br>
    <br>
</div>
<script type="text/javascript">
    var win_bool = false;
    var mobi_reg = /^1[3456789]\d{9}$/;
    var id_reg = /(^\d{15}$)|(^\d{17}([0-9]|X)$)/;
    $('.win_btn').click(function () {
        $(".receiving_information input").each(function(){
            var that_val = $(this).val();
            var placeholder_val = $(this).attr('placeholder');
            var mobi_val = $('#receive_member_mobile').val();
            var id_val = $('#receive_identity_number').val();
            if (that_val == '') {
                mui.toast(placeholder_val);
                $(this).focus();
                win_bool = false;
                return false;
            }else{
                win_bool = true;
            }
            if (mobi_val) {
                if ( ! (mobi_reg.test(mobi_val)) ) {
                    mui.toast('请输入正确的手机号');
                    $('#mobi').focus();
                    win_bool = false;
                    return false;
                }
            }
            if (id_val) {
                if ( ! (id_reg.test(id_val)) ) {
                    mui.toast('请输入正确的身份证号码');
                    $('#id_no').focus();
                    win_bool = false;
                    return false;
                }
            }

        });
        if (win_bool == true) {
            var data = {
                'receive_member_name':$('#receive_member_name').val(),
                'receive_member_mobile':$('#receive_member_mobile').val(),
                'receive_address':$('#receive_address').val(),
                'receive_identity_number':$('#receive_identity_number').val(),
                '_csrf':'<?=Yii::$app->request->csrfToken?>'
            };
            ajaxPost('<?=\yii\helpers\Url::to(['/site/receive-address','roster_id' => $content['id']])?>',data,function (data) {
                if (data.code == 200) {
                    $('.win_wrap').show()
                } else {
                    mui.toast(data.message);
                }
            });
        }
    })
    function openIndex() {
        var result = {"action":"index"}
        var ua = navigator.userAgent.toLowerCase();
        if (/iphone|ipad|ipod/.test(ua)) {
            webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
        }else if(/android/.test(ua)) {
            window.jsObj.HtmlcallJava(JSON.stringify(result));
        }
    }
    mui('body').on('tap','a',function(){
        window.top.location.href = this.href;
    });

</script>