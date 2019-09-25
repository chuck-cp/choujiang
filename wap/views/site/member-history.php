<?
$this->title = "往期抽奖记录";
$date = \wap\models\ActivityDate::find()->select(['prize_date'])->column();
if(!empty($date)){
    array_unshift($date,date('Y-m-d',strtotime($date[0])-3600*24));
    array_pop($date);
}

?>
<style type="text/css">
    body{background-color: white}
    a.mui-action-back.mui-icon.mui-icon-left-nav.mui-pull-left { color: #ccc; }
    .mui-bar-nav~.mui-content{ padding-top: 58px; }
    .numb{  padding: 3%; display: inline-block; width: 100%;  }
    .nr_numb{ overflow: hidden; }
    .nr_sub{ margin-bottom: 10px;}
    .left_p{ float: left; color: #323232; font-size: 16px;font-weight: bold; }
    .right_p p{ float: right; color: #999999; font-size: 12px; }
    .li_left{ float: left;}
    .ul_nr{ margin-top: -4px; background: #fff; }
    .re_cord{ border-bottom: 1px solid #f0f0f0; padding: 3%; display: inline-block; width:100%; margin-bottom: -4px; overflow: hidden;}
    .li_left{ float: left; }
    .mui-btn{ float: right; color: #ccc; background: #fff; border-color: #ccc; border-radius: 20px; margin-top: 1%; }
    p.nu_font{ font-size: 14px; }
    p.time_p{ color: #cccccc; }
    .btn_prize{ background: #ff8800; color: #fff; border-color: #ff8800;}
    a{color: #FFFFFF;}
    a:active{color: #FFFFFF;}
    .record_date{width: 26px;}
    .mui-btn-warning:enabled:active{background: #fff; border-color: #ccc;    color: #ccc;}
    /* 日期 */
    .shade{position: fixed;top: 0;left: 0;right: 0;bottom: 0;background: rgba(0,0,0,.6);display: none;}
    .sel_date{position: absolute; top: 48px; right: 5%; background: #ffffff; text-align: center; padding: 0; font-size: 12px; padding-left: 5%; padding-right: 5%; padding-top: 4px; padding-bottom: 4px; color: #999999; line-height: 2.2; border-radius: 6px;display: none;}
    .cur_sel{color: #ff8800;}
</style>
</head>
<body style="background: #f0f0f0;">
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">抽奖记录</h1>
</header>
<div class="mui-content">
    <div class="nr_sub" id="nomore" style="display: none;">
        <div class="img_icon" style="margin-top: 30%;text-align: center">
            <img style="width: 40%" src="/static/img/no_award.png">
            <p style="text-align: center;width: 59%; margin: 0 auto;color: #cccccc;">暂无抽奖记录</p>
        </div>
    </div>
</div>
<!-- 遮罩 -->
<div class="shade" ></div>
<!-- 日期选择 -->
<?if(!empty($date)):?>
    <ul class="sel_date" >
        <?foreach ($date as $v):?>
            <li><?=$v?></li>
        <?endforeach;?>
    </ul>
<?endif;?>
<input type="hidden" name="" value="" id="resdate">
<script src="/static/js/jquery1.7.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/com.js" type="text/javascript" charset="utf-8"></script>
<script>
    var days = <?=json_encode($date)?>;
    $('.record_date').live('click', function () {
        $('.shade,.sel_date').show();
    });
    $('.sel_date li').live('click', function () {
        var sel_val = $(this).text();
        $('#resdate').val(sel_val)
        $('.sel_date').hide();
        $('.loading').show();
        initPage(sel_val,1,'replace')
        setTimeout(shade_close,500)
    });
    function shade_close () {
        $('.shade').hide();
    }


        //滚动加载
        var page = 1;
        window.addEventListener('swipeup',function(){
            var doc_height = $(document).height();
            var scroll_top = $(document).scrollTop();
            var window_height = $(window).height();
            var dt = $('#resdate').val();
            if(scroll_top + window_height >= doc_height){
                page ++;
                $.ajax({
                    url:"/site/history?page="+page+"date="+dt+"&member_id=<?=\common\tools\Cookie::get('member_id')?>",
                    type:"get",
                    dataType:"json",
                    success:function (phpdata) {
                        if(!phpdata.data.length){
                            if(!$('#myl').length){
                                $('.mui-content').append('<p id="myl" style="text-align: center;color: #cccccc;line-height: 20px;">没有更多了</p>');
                            }

                            return false;
                        }
                        var shtml = '';
                        $.each(phpdata.data, function (i,value) {
                            var rl = '';
                            var jx = '';
                            if(!value.prize_title){
                                jx = '</div><button type="button" class="mui-btn mui-btn-warning">未中奖</button></div>'
                            }else{
                                jx = '</div><button type="button" class="mui-btn mui-btn-warning btn_prize">'+value.prize_title+' <a href="<?=\yii\helpers\Url::to(['/site/prize'])?>">查看奖品</a></button></div>'
                            }
                            var mont = '';
                            if($("p[date-date="+value.month+"]").length > 0){
                                mont = ''
                            }else{
                                mont = value.month
                            }
                            shtml = shtml + '<div class="nr_sub">' +
                                '<div class="numb"><div class="nr_numb"><p class="left_p" date-date='+value.month+'>'+mont+'</p><div class="right_p">'+rl+'</div></div></div>	' +
                                '<div class="ul_nr">' +
                                '<div class="re_cord"><div class="li_left"><p class="nu_font">'+value.prize_code+'</p><p class="time_p">'+value.create_at+'</p>' + jx


                        });
                        if(shtml){
                            $('.mui-content').append(shtml);
                        }

                    },error:function () {
                        console.log('error')
                    }
                })
            }
        });
        initPage('',1);
        //默认
        function initPage(dt,page,pl) {
            $.ajax({
                url:"/site/history?page="+page+"&date="+dt+"&member_id=<?=\common\tools\Cookie::get('member_id')?>",
                type:"get",
                dataType:"json",
                success:function (phpdata) {
                    if(!phpdata.data.length){
                        if(page == 1){
                            $('.mui-content').html('<div class="nr_sub" id="nomore" style="display: block;"><div class="img_icon" style="margin-top: 30%;text-align: center"><img style="width: 40%" src="/static/img/no_award.png"><p style="text-align: center;width: 59%; margin: 0 auto;color: #cccccc;">暂无抽奖记录</p></div></div>');
                        }

                        return false;
                    }
                    var shtml = '';
                    $.each(phpdata.data, function (i,value) {
                        var rl = '';
                        if(i == 0 && days.length > 0){
                            rl = '<p><img class="record_date" src="/static/img/record_date.png" ></p>';

                        }
                        var jx = '';
                        if(!value.prize_title){
                            jx = '</div><button type="button" class="mui-btn mui-btn-warning">未中奖</button></div>'
                        }else{
                            jx = '</div><button type="button" class="mui-btn mui-btn-warning btn_prize">'+value.prize_title+' <a href="<?=\yii\helpers\Url::to(['/site/prize'])?>">查看奖品</a></button></div>'
                        }
                        shtml = shtml + '<div class="nr_sub">' +
                            '<div class="numb"><div class="nr_numb"><p class="left_p" date-date='+value.month+'>'+value.month+'</p><div class="right_p">'+rl+'</div></div></div>	' +
                            '<div class="ul_nr">' +
                            '<div class="re_cord"><div class="li_left"><p class="nu_font">'+value.prize_code+'</p><p class="time_p">'+value.create_at+'</p>' + jx


                    });
                    if(pl == 'replace'){
                        if(shtml){
                            $('.mui-content').html(shtml);
                        }
                        return;
                    }
                    $('.mui-content').append(shtml);

                },error:function () {
                    console.log('error')
                }
            })
        }



</script>
