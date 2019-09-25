<?php
//p($content);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<title>我的抽奖码</title>
		<style type="text/css">
    a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left { color: #ccc; }
    .mui-bar-nav{ border: 0; box-shadow: none; }
			.mui-bar .mui-title{ color: #fff; }
        a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left{ color: #fff; }
            .time_draw{ background: linear-gradient(to right, #ff8f0b , #e5531d); text-align: center; padding: 10%; padding-top: 4%;    padding-bottom: 15%; }
			.time_draw p{ color: #fff; font-size: 14px; }
                    .draw_md{ background: #000; height: 40px; line-height: 40px; }
                        .draw_md p{ width: 50%;text-align: center;float: left; font-size: 14px; }
			.draw_md p a{ color: #cccccc; }
                            .tips_p{ color: #999999; margin: 3%; }
                                .ul_nr{ background: #fff; width: 100%; }
                                    .re_cord{ border-bottom: 1px solid #f0f0f0; padding: 3%; display: inline-block; width:100%;  }
                                    .li_left{ float: left; }
			.mui-btn{ float: right; color: #ccc; background: #fff; border-color: #ccc; border-radius: 20px; margin-top: 1%; }
                                            p.nu_font{ font-size: 14px; }
			p.time_p{ color: #cccccc; }
                                                .btn_time{ color: #ff8800; border-color: #ff8800; }
                                                    .btn_prize{ background: #ff8800; color: #fff; border-color: #ff8800;}
                                                        .zj_img{ position: relative; display: inline-block; text-align: center; margin-top: 10px; }
			.zj_img img{ width: 100%; }
			.absolute_p{ position: absolute; top: 16%; left: 33%; }
			.absolute_p p{ color: #ff4200; }
                                                            .absolute_p p a{ color: #fff; }
                                                                .mui-btn-warning:enabled:active{color: #ccc; background: #fff;border-color: #ccc;}
                                                                    .btn_prize:enabled:active{background: #ff8800; color: #fff; border-color: #ff8800;}
                                                                        .btn_time:enabled:active{background-color:#FFFFFF ;    color: #ff8800;    border-color:#ff8800}
			/* 开奖选中 */
			.win_box{width: 92%;margin: 0 auto;height: 50px;background: #FFFFFF;border-radius: 6px;box-shadow: 3px 6px 6px rgba(90,16,0,.1);position: relative; top: -20px;line-height: 50px;text-align: center;overflow: hidden;}
			.win_sta1{font-size: 14px;color: #323232;float: left; margin-left: 17%;border-bottom: 4px solid #FFFFFF; line-height: 42px; padding-top: 4px;}
			.win_sta2{float: right;font-size: 14px;color: #323232; margin-right: 17%;border-bottom: 4px solid #FFFFFF; line-height: 42px; padding-top: 4px;}
			.win_record{float: left;width: 44%;height: 40px;line-height: 40px;font-size: 14px;background: #FFFFFF;border: 1px solid #FFFFFF;color: #f37313; border-radius: 40px;}
			.win_min{float: right;width: 44%;height: 40px;line-height: 40px;font-size: 14px;border: 1px solid #FFFFFF;color: #FFFFFF; border-radius: 40px;}
                                                                                            .win_record:active{color: #f37313;}
                                                                                                .win_min:active{color: #FFFFFF;}
                                                                                                    .win_sel{border-bottom: 4px solid #f37313;font-weight: bold;color: #f37313}
                                                                                                    .mui-btn-org{color: #ff8800;border: 1px #ff8800 solid;}
                                                                                                        .re_cord:last-child{border-bottom: 0;}
			.luck_draw_box{display: none;}
			.img_icon { padding: 8%; padding-top: 4%; text-align: center; }
			.img_icon img { width: 49%; margin-bottom: 18px; }
			.win_btn { width: 83%; height: 48px; line-height: 48px; background: #ff8800; border: 0; border-radius: 48px; color: #ffffff; font-size: 16px; display: inline-block; }
			.win_btn:active{color: #FFFFFF;}
                                                                                                                </style>
	</head>
	<body style="background: #f0f0f0;">
		<header id="header" class="mui-bar mui-bar-nav" style="background: linear-gradient(to right, #ff8f0b , #e5531d);">
            <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?=\yii\helpers\Url::to(['/','i' => $activity['id']])?>"></a>
			<h1 class="mui-title">我的抽奖码</h1>
		</header>
		<div class="mui-content">
			<div class="opening_tips" style="color: #e5531d;font-size: 12px;background: #ffead5;padding: 3%; line-height: 1.4;">
                                                                                                                    天天答题，天天转发得抽奖码，天天抽大奖。
			</div>
			<div class="time_draw">
				<p>开奖时间（次日）</p>
				<p style="margin-top: 10px; font-weight: bold; font-size: 30px;line-height: 1;"><?=\common\tools\System::convertPrizeTime($activity['prize_time'])?></p>
				<div style="overflow: hidden;margin-top: 10%;">
					<a class="win_record"  href="<?=\yii\helpers\Url::to(['history'])?>">抽奖记录</a>
					<a class="win_min "  href="<?=\yii\helpers\Url::to(['roster'])?>">已开奖中奖名单</a>
				</div>
			</div>
			<div class="win_wrap_con" >
				<div class="win_box">
					<span class="win_sta1 win_sel" >今日开奖</span><span class="win_sta2 " >今日抽奖码</span>
				</div>
			</div>
			<div class="lottery_box mui-clearfix" style="background: #fff;">
				<p class="tips_p">温馨提示：中奖后需点击“领取奖品”按钮在一把一把捞APP内回答问题领取您的奖品，若用户在10天内未领取奖品，则视为用户自动放弃领奖资格。</p>
                <? if($content['yestoday']):?>
                    <div class="ul_nr " >
                        <?foreach ($content['yestoday'] as $value):?>
                                <? if(!$value['prize_title']):?>
                                    <div class="re_cord">
                                        <div class="li_left">
                                            <p class="nu_font"><?=$value['prize_code']?></p>
                                            <p class="time_p"><?=$value['create_at']?></p>
                                        </div>
                                        <button type="button" class="mui-btn mui-btn-warning">
                                            <?if((date('H') < 9)):?>
                                                未到开奖时间
                                            <?else:?>
                                                未中奖
                                            <?endif;?>
                                        </button>
                                    </div>
                                <? else:?>
                                    <?if((date('H') < 9)):?>
                                        <div class="re_cord">
                                            <div class="li_left">
                                                <p class="nu_font"><?=$value['prize_code']?></p>
                                                <p class="time_p"><?=$value['create_at']?></p>
                                            </div>
                                            <button type="button" class="mui-btn mui-btn-warning btn_prize">未到开奖时间</button>
                                        </div>
                                    <?else:?>
                                        <div class="re_cord">
                                            <div class="li_left">
                                                <p class="nu_font"><?=$value['prize_code']?></p>
                                                <p class="time_p"><?=$value['create_at']?></p>
                                            </div>
                                            <button type="button" class="mui-btn mui-btn-warning btn_prize">中奖啦</button>
                                            <div class="zj_img">
                                                <img src="/static/img/bg_draw.png">
                                                <div class="absolute_p">
                                                    <p style="font-size: 18px; font-weight: bold;"><?=$value['prize_title']?></p>
                                                    <p style="font-size: 14px; "><?=$value['prize_name']?></p>
                                                    <p style="background: #ff4200;background: #ff4200; padding: 2%; border-radius: 20px;"><a>领取奖品</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>

                                <? endif;?>
                        <?endforeach;?>
                    </div>
                <? endif;?>
			</div>
			<div class="luck_draw_box mui-clearfix">
                <?if($content['today']):?>
                    <?foreach ($content['today'] as $v):?>
                        <div class="ul_nr">
                            <div class="re_cord">
                                <div class="li_left">
                                    <p class="nu_font"><?=$v['prize_code']?></p>
                                    <p class="time_p"><?=$v['create_at']?></p>
                                </div>
                                <span  class="mui-btn mui-btn-org">未到开奖时间</span>
                            </div>
                        </div>
                    <?endforeach;?>
                <?endif;?>
			</div>
			<!-- 无抽奖码状态 还没有抽奖码，快去参加活动吧！-->
<!--            --><?//if(empty($content['today'])):?>
<!--                <div class="no_code" style="display: block;">-->
<!--            --><?// elseif($content['today'] || empty($content['yestoday'])):?>
<!--                <div class="no_code" style="display: none;">-->
<!--            --><?// endif;?>
            <div class="no_code" style="display: none;">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="img_icon">
                        <img src="/static/img/no_award1.png">
                        <p style="text-align: center;width: 100%; margin: 0 auto;color: #999999;">还没有抽奖码，马上参加活动吧！</p>
                    </div>
                    <div class="cjhd" style="text-align: center; display: none;">
                        <a href="<?=\yii\helpers\Url::to(['/','i' => $activity['id']])?>" class="win_btn">去参加活动</a>
                    </div>
                    <br>
                </div>

			<!-- /无抽奖码状态 还没有抽奖码，快去参加活动吧！-->
		</div>
<script src="/static/js/jquery1.7.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/com.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var yestoday = <?=json_encode($content['yestoday'])?>;
            if(yestoday.length == 0){
                $('.no_code').css({'display':'block'});
            }
            $('.win_sta1').click(function () {
                if(yestoday.length == 0){
                    $('.cjhd').css({'display':'none'});
                }
                $('.win_sta1').addClass('win_sel');
                $('.win_sta2').removeClass('win_sel');
                $('.luck_draw_box').hide();
                $('.lottery_box').show();
            })
            $('.win_sta2').click(function () {
                var today = <?=json_encode($content['today'])?>;
                if(today.length == 0){
                    $('.no_code').css({'display':'block'});
                    $('.cjhd').css({'display':'block'});
                }
                $('.win_sta2').addClass('win_sel');
                $('.win_sta1').removeClass('win_sel');
                $('.lottery_box').hide();
                $('.luck_draw_box').show();

            })
        </script>
<script>
    mui('body').on('tap','a',function(){
        window.location.href = this.href;
    });
</script>
	</body>
</html>
