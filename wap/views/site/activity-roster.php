<?$this->title = "中奖名单"?>
<link rel="stylesheet" type="text/css" href="/static/css/mui.picker.min.css"/>
<script src="/static/js/mui.picker.min.js" type="text/javascript" charset="utf-8"></script>

<style type="text/css">
    .body_bg{ background: #b73d35; }
    .mui-bar-nav~.mui-content{ background: none;}
    .mui-content{ width: 90%; margin: 0 auto; }
    .img_time{ float: right; width: 26px;  }
    .jp_main{ margin-bottom: 6%; }
    .jp_main h2{ background: #fec245; color: #fff; width: 30%; text-align: center; font-size: 16px; padding: 8px; border-radius: 10px 10px 0 0; text-shadow: 3px 3px 4px #da8b34; }
    .nr_yd{ background: #fefcf6; border: 6px solid #fec85b; border-radius: 0 10px 10px 10px; box-shadow: 0px 5px 7px 0px rgba(0, 0, 0, 0.1); margin-top: -5px; padding: 3%; padding-bottom: 0; font-size: 14px; }
    .main_ul{ margin: 0; padding: 0; width: 100%; display: inline-block; }
    .main_ul li{ width: 50%; margin-bottom: 3%; text-align: center; float: left; }
    #result{  color: #fff; }
    .date_box{overflow: hidden;padding-top: 16px;}
    .date_box .btn,button:enabled:active{background: url(/static/img/img_time.png) no-repeat;width: 26px;height: 26px;float: right;background-size: 100%;border: 0;}
    .mui-btn-blue{background: #fec245;border: 0;}
    /* 日期 */
    .shade{position: fixed;top: 0;left: 0;right: 0;bottom: 0;background: rgba(0,0,0,.6);display: none;}
    .sel_date{position: absolute; top: 48px; right: 5%; background: #ffffff; text-align: center; padding: 0; font-size: 12px; padding-left: 5%; padding-right: 5%; padding-top: 4px; padding-bottom: 4px; color: #999999; line-height: 2.2; border-radius: 6px;display: none;}
    .cur_sel{color: #ff8800;}

    .img_icon{ padding: 8%; padding-top: 30%; text-align: center;  }
    .img_icon img{ width: 49%; margin-bottom: 18px; }
    .img_icon p{ font-size: 14px; color: #999999; text-align: left; }


</style>

<!-- 头部导航 -->
<header id="header" class="mui-bar mui-bar-nav" style="background: #fff;">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #cccccc;"></a>
    <h1 class="mui-title">中奖名单</h1>
</header>
<!-- 头部导航 -->
<div class="mui-content">
        <div class="date_box">
            <span id="result"><?=$prize_date[0]?></span><button class="btn" id='demo2' type="button" ></button>
        </div>

        <div id="roster">
            <?
            if ($prize_roster) :
            foreach ($prize_roster as $key => $value):?>
                <div class="jp_main">
                    <h2><?=$key?></h2>
                    <div class="nr_yd">
                        <ul class="main_ul">
                            <?foreach ($value as $code):?>
                                <li><?=$code?></li>
                            <?endforeach;?>
                        </ul>
                    </div>
                </div>
            <?endforeach;
            else: ?>
               <div class="nr_sub">
                   <div class="img_icon">
                        <img src="/static/img/no_award.png">
                        <p style="text-align: center;width: 59%; margin: 0 auto;color: #e2b1ae;">暂无相关信息</p>
                    </div>
                </div>
            <?endif;?>
        </div>

    </div>
    <div class="shade" ><img class="loading" style="margin-top: 36vh; margin-left: 44vw; width: 10vw;" src="/static/img/loading.gif" ></div>
    <!-- 日期选择 -->
    <ul class="sel_date">
        <?foreach ($prize_date as $date) {
            echo "<li>{$date}</li>";
        }?>
    </ul>

    <script>
        function shade_close () {
            $('.shade').hide();
        }
        $('.btn').click(function () {
            $('.loading').hide();
            $('.shade,.sel_date').show();
        });
        $('.sel_date li').click(function () {
            $('.sel_date').hide();
            $('.loading').show();
            var sel_val = $(this).text();
            var i = '';
            $.ajax({
                timeout : 3000,
                url:'<?=\yii\helpers\Url::to(['site/roster'])?>?date='+sel_val,
                type:'GET',
                dataType:"json",
                success:function (data) {
                    $('#result').html(sel_val);
                    if (data.message == null || data.message == '') {
                        $('#roster').html(
                            '    <div class="nr_sub">\n' +
                            '        <div class="img_icon">\n' +
                            '            <img src="/static/img/no_award.png">\n' +
                            '            <p style="text-align: center;width: 59%; margin: 0 auto;color: #e2b1ae;">暂无相关信息</p>\n' +
                            '        </div>\n' +
                            '    </div>'
                        )
                    } else {
                        var html = '';
                        $.each(data.message,function (index,item) {
                            html += "<div class='jp_main'><h2>"+index+"</h2>";
                            html += '<div class="nr_yd"><ul class="main_ul">';
                            for(i in item) {
                                html +=  '<li>'+ item[i] +'</li>';
                            }
                            html += '</ul></div></div>';
                        });
                        $('#roster').html(html);
                    }
                    shade_close();

                },error:function (data) {
                    mui.toast("服务器错误");
                    shade_close();
                    $('.sel_date').hide();
                }
            });
        });

    </script>
