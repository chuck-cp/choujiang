<?
$this->title = "我的抽奖码";
?>
<style type="text/css">
    .body_bg{background-color: #ffffff;}
    a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left { color: #ccc; }
    .mui-bar-nav{ border: 0; box-shadow: none; }
    .mui-bar .mui-title{ color: #fff; }
    a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left{ color: #fff; }
    .time_draw{ background: linear-gradient(to right, #ff8f0b , #e5531d); text-align: center; padding: 10%; padding-top: 4%; }
    .time_draw p{ color: #fff; font-size: 14px; }
    .draw_md{ background: #000; height: 40px; line-height: 40px; }
    .draw_md p{ width: 50%;text-align: center;float: left; font-size: 14px; }
    .draw_md p a{ color: #cccccc; }
    .tips_p{ color: #999999; margin: 3%; }
    .ul_nr{ background: #fff; width: 100%; }
    .re_cord{ border-bottom: 1px solid #f0f0f0; padding: 3%; display: inline-block; width:100%; float: left; }
    .li_left{ float: left; }
    .mui-btn{ float: right; color: #ccc; background: #fff; border-color: #ccc; border-radius: 20px; margin-top: 1%; }
    p.nu_font{ font-size: 14px; }
    p.time_p{ color: #cccccc; }
    .btn_time{ color: #ff8800; border-color: #ff8800; }
    .btn_prize{ background: #ff8800; color: #fff; border-color: #ff8800;}
    .zj_img{ position: relative; display: inline-block; text-align: center; margin-top: 10px; }
    .zj_img img{ width: 100%; }
    .absolute_p{ position: absolute; left: 0;top: 12%;width: 100%}
    .absolute_p p{ color: #ff4200; }
    .absolute_p p a{ color: #fff; }
    .img_icon{ padding: 8%; padding-top: 4%; text-align: center;  }
    .img_icon img{ width: 49%; margin-bottom: 18px; }
    .img_icon p{ font-size: 14px; color: #999999; text-align: left; }
    .mui-btn-warning:enabled:active{color: #ccc; background: #fff;border-color: #ccc;}
    .btn_prize:enabled:active{background: #ff8800; color: #fff; border-color: #ff8800;}
    .btn_time:enabled:active{background-color:#FFFFFF ;    color: #ff8800;    border-color:#ff8800}
</style>
<header id="header" class="mui-bar mui-bar-nav" style="background: linear-gradient(to right, #ff8f0b , #e5531d);">
    <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?=\yii\helpers\Url::to(['/','i' => $activity['id']])?>"></a>
    <h1 class="mui-title">我的抽奖码</h1>
</header>
<div class="mui-content">
    <?if ($activity) :?>
    <div class="opening_tips" style="color: #e5531d;font-size: 12px;background: #ffead5;padding: 3%; line-height: 1.4;">
        所有抽奖码在本期活动15天内均有效，每天都可以参与抽奖6666
    </div>
    <div class="time_draw">
        <p>每天开奖时间</p>
        <p style="margin-top: 10px; font-weight: bold; font-size: 30px;"><?=\common\tools\System::convertPrizeTime($activity['prize_time'])?></p>
    </div>
    <?endif;?>
    <div class="draw_md">
        <p style=""><a href="<?=\yii\helpers\Url::to(['history'])?>">往期抽奖记录</a></p>
        <p style=""><a href="<?=\yii\helpers\Url::to(['roster'])?>">已开奖中奖名单</a></p>
    </div>
    <div style="background: #fff;overflow: hidden">
        <?if ($content) :?>
        <p class="tips_p">温馨提示：中奖后需点击“领取奖品”按钮在一把一把捞APP内回答问题领取您的奖品，若用户在10天内未领取奖品，则视为用户自动放弃领奖资格。</p>
        <div class="ul_nr">
            <?foreach ($content as $value):?>
                <div class="re_cord">
                    <div class="li_left">
                        <p class="nu_font"><?=$value['prize_code']?></p>
                        <p class="time_p"><?=$value['create_at']?></p>
                    </div>
                    <?if ($activity['activity_start_at'] > time() || (date('H') < 9)) :
                        if ($value['prize_title'] && $value['prize_date'] != date('Y-m-d')) :
                            ?>
                            <button type="button" class="mui-btn mui-btn-warning btn_prize">中奖了</button>
                            <a href="<?=\yii\helpers\Url::to(['site/prize'])?>">
                                <div class="zj_img">
                                    <img src="/static/img/bg_draw.png">
                                    <div class="absolute_p" style="width: 100%">
                                        <p style="font-size: 18px;font-weight: bold;margin-top: 1%;"><?=$value['prize_title']?></p>
                                        <p style="font-size: 14px;width: 86%;margin: 0 auto;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;margin-top: 1%;margin-bottom: 2%;"><?=$value['prize_name']?><?=is_numeric($value['prize_name']) ? "元现金" : ''?></p>
                                        <p style="background: #ff4200;padding: 1%;border-radius: 20px;width: 32%;margin: 0 auto; color: white">领取奖品</p>
                                    </div>
                                </div>
                            </a>
                        <?
                        else:
                            echo '<button type="button" class="mui-btn mui-btn-warning btn_time">未到开奖时间</button>';
                        endif;
                     elseif ($value['prize_title']):?>
                        <button type="button" class="mui-btn mui-btn-warning btn_prize">中奖了</button>
                        <a href="<?=\yii\helpers\Url::to(['site/prize'])?>">
                            <div class="zj_img">
                                <img src="/static/img/bg_draw.png">
                                <div class="absolute_p" style="width: 100%">
                                    <p style="font-size: 18px;font-weight: bold;margin-top: 1%;"><?=$value['prize_title']?></p>
                                    <p style="font-size: 14px;width: 86%;margin: 0 auto;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;margin-top: 1%;margin-bottom: 2%;"><?=$value['prize_name']?><?=is_numeric($value['prize_name']) ? "元现金" : ''?></p>
                                    <p style="background: #ff4200;padding: 1%;border-radius: 20px;width: 32%;margin: 0 auto; color: white">领取奖品</p>
                                </div>
                            </div>
                        </a>
                    <?else:
                        echo '<button type="button" class="mui-btn mui-btn-warning">未中奖，明天还有机会</button>';
                    endif;?>
                </div>
            <?endforeach;?>
        </div>
        <?else:?>
            <br><br>
            <div class="img_icon">
                <img src="/static/img/no_award1.png">
                <p style="text-align: center;width: 100%; margin: 0 auto;color: #999999;">您还没有抽奖码！</p>
            </div>
        <?endif?>
    </div>
</div>
<script>
    mui('body').on('tap','a',function(){
        window.location.href = this.href;
    });
</script>