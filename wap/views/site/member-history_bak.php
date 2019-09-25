<?
$this->title = "往期抽奖记录"
?>
<style type="text/css">
    a{color: #ffffff}
    a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left { color: #ccc; }
    .mui-bar-nav~.mui-content{ padding-top: 58px; }
    .numb{ background: #fff; padding: 3%; display: inline-block; width: 100%; border-bottom: 1px solid #f0f0f0; }
    .nr_numb{ margin-bottom: 34px; }
    .nr_sub{ margin-bottom: 14px;}
    .img_icon{ padding: 8%; padding-top: 4%; text-align: center;  }
    .img_icon img{ width: 49%; margin-bottom: 18px; }
    .img_icon p{ font-size: 14px; color: #999999; text-align: left; }
    .left_p{ float: left; color: #323232; font-size: 14px; }
    .right_p p{ float: right; color: #999999; font-size: 12px; }
    .li_left{ float: left;}
    .ul_nr{ margin-top: -4px; background: #fff; }
    .re_cord{ border-bottom: 1px solid #f0f0f0; padding: 3%; display: inline-block; width:100%; margin-bottom: -4px; }
    .li_left{ float: left; }
    .mui-btn{ float: right; color: #ccc; background: #fff; border-color: #ccc; border-radius: 20px; margin-top: 1%; }
    p.nu_font{ font-size: 14px; }
    p.time_p{ color: #cccccc; }
    .btn_prize{ background: #ff8800; color: #fff; border-color: #ff8800;}
    a:active{color: #FFFFFF;}
</style>
<body style="background: #f0f0f0;">
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">往期抽奖记录</h1>
</header>
<div class="mui-content">
    <?if ($content):?>
        <?foreach ($content as $value):?>
            <div class="nr_sub">
<!--                <div class="numb">-->
<!--                    <div class="nr_numb">-->
<!--                        <p class="left_p">--><?//=$value['activity']['title']?><!--</p>-->
<!--                        <div class="right_p"><p>--><?//=$value['activity']['subtitle']?><!--</p></div>-->
<!--                    </div>-->
<!--                    <div class="nr_numb">-->
<!--                        <p class="left_p">活动时间</p>-->
<!--                        <div class="right_p">-->
<!--                            <p>--><?//=$value['activity']['start_at']?><!-- 至 --><?//=$value['activity']['end_at']?><!--</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="ul_nr">
                    <?foreach ($value as $listValue):?>
                    <div class="re_cord">
                        <div class="li_left">
                            <p class="nu_font"><?=$listValue['prize_code']?></p>
                            <p class="time_p"><?=$listValue['create_at']?></p>
                        </div>
                        <?if(empty($listValue['prize_title'])):?>
                            <button type="button" class="mui-btn mui-btn-warning">
                                未中奖
                            </button>
                        <?else:?>
                            <button type="button" class="mui-btn mui-btn-warning btn_prize">
                                <?=$listValue['prize_title']?> <a href="<?=\yii\helpers\Url::to(['/site/prize'])?>">查看奖品</a>
                            </button>
                        <?endif;?>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        <?endforeach;?>
    <?else:?>
        <div class="nr_sub">
            <div class="img_icon" style="margin-top: 30%">
                <img src="/static/img/no_award.png">
                <p style="text-align: center;width: 59%; margin: 0 auto;color: #cccccc;">暂无抽奖记录</p>
            </div>
        </div>
    <?endif?>
</div>
<script type="text/javascript">
    $(function () {
        //滚动加载
        var page = 0;
        $(window).scroll(function(){
            var doc_height = $(document).height();
            var scroll_top = $(document).scrollTop();
            var window_height = $(window).height();
            if(scroll_top + window_height >= doc_height){
                page ++;
                $.ajax({
                    url:"/site/history?page="+page+"&member_id=<?=\common\tools\Cookie::get('member_id')?>",
                    type:"get",
                    dataType:"json",
                    success:function (phpdata) {
                        console.log(phpdata)
                    },error:function () {
                        console.log('error')
                    }
                })
            }
        });
    })
</script>
