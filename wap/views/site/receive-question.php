<?$this->title = "领取奖品"?>
<style type="text/css">
    .body_bg{background: #bc4038;}
    p{font-size: 12px;}
    strong{color: #323232;font-size: 13px;}
    .top_box{position: relative;}
    .img_bg{width: 100%;display: block;}
    .do_answer{border: 8px solid #fec245; border-radius: 8px; position: relative;margin-bottom: 10%; background: #fff9e9;  box-shadow: 2px 8px 18px rgba(89,5,0,.7);}
    .do_answer_img{width: 188px; position: absolute; top: -24px; left: 50%; margin-left: -27%;}
    .btn_tt{width: 84px;height: 24px;line-height: 24px;text-shadow: 2px 2px 2px rgba(144,24,17,.4); font-weight: bolder; color: #FFFFFF; display: inline-block; text-align: center; font-size: 12px;border-radius: 24px;
        background: -webkit-linear-gradient(#fec046, #fd694d); /* Safari 5.1 - 6.0 */
        background: -o-linear-gradient(#fec046, #fd694d); /* Opera 11.1 - 12.0 */
        background: -moz-linear-gradient(#fec046, #fd694d); /* Firefox 3.6 - 15 */
        background: linear-gradient(#fec046, #fd694d); /* 标准的语法 */
    }
    .justdoit{margin-top: -2%}
    .answer_main{ padding-right: 6%; padding-left: 6%; padding-top: 10%; padding-bottom: 4%;}
    .do_answer_tt p,.do_answer_box p{background: url(/static/img/def_sel.png) no-repeat left 3px; background-size: 14px;    padding-left: 24px;}
    .do_answer_tt .cur_sel,.do_answer_box .cur_sel{background-image: url(/static/img/cur_sel.png);}
    .zqhd{margin-top: 4%; margin-bottom: 20px;}
    .btn_answer{width: 83%;margin: 0 auto;    margin-top: 4%;}
    .answer1_read{padding-top: 2%; padding-bottom: 6%;}
    .answer1_read p{text-indent: 2rem;margin-bottom: 0;}
    .answer_notes{color: #666666; position: absolute; top: 60%; width: 72%; left: 50%; margin-left: -35%;    line-height: 1.6;}
    @media screen and (max-width: 320px) {
        .body_bg{line-height: 1.5;}
        .do_answer_tt p{margin-bottom: 4px;}
        .zqhd{margin-bottom:10px}
        .do_answer_img{    width: 158px;    top: -21px;}
    }
    /* 答案提示信息 */
    .answer_tag { width: 70%; min-height: 40px; text-align: center; background: rgba(0,0,0,.7); color: #fff; position: fixed; left: 50%; top: 50%; margin-left: -34%; margin-top: -20px; border-radius: 6px; font-size: 14px; display: none; z-index: 100;padding: 10px;font-size: 16px; }
    p{color: #323232;font-size: 14px}
</style>

<!-- 头部导航 -->
<div class="" style="position: relative;">
    <div class="header" style="position: absolute;width: 100%;top: 0; z-index: 1; padding-top: 10px; padding-left: 2px;">
        <div class="layout mui-clearfix">
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF;"></a>
            <a href="javascript:" class="mui-pull-right share" style="padding-top: 4px;padding-right: 2%;"><img style="width: 16px;" src="/static/img/share_btn.png" ></a>
            <h1 class="" style="color: #FFFFFF;font-size: 17px;text-align: center;font-weight: normal;">问答转发抽奖</h1>
        </div>
    </div>
</div>
<!-- 头部导航 -->
<div class="top_box">
    <img class="img_bg" src="/static/img/answer_bg2.jpg" >
    <p class="answer_notes">领奖前记得先答题哦，麻烦您动动手指帮小编再答一下吧，答完就可以立刻领奖啦！</p>
</div>
<!-- 必答题 -->
<?foreach ($content as $key => $value):?>
    <div class="layout do_answer justdoit">
        <img class="do_answer_img" src="/static/img/answer/ans<?=++$key?>.png" >
        <div class="answer_main">
            <b class="btn_tt" >请先阅读</b>
            <p class="zqhd"><?=$value['description']?></p>
            <b class="btn_tt" >请答题</b>
            <p class="zqhd"><strong><?=$value['title']?></strong></p>
            <div  class="do_answer_box" suc="">
                <?foreach (explode(",",$value['answer']) as $answerKey => $answerValue):?>
                    <p><input answer="<?=$value['correct_answer'] == $answerValue ? 'right' : ''?>" type="radio" name="question_<?=$value['id']?>" value="<?=$answerValue?>" hidden="hidden" /><?=\common\tools\System::getAnswerKey($answerKey)?>. <?=$answerValue?></p>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endforeach;?>
<div class="btn_answer">
    <img class="img_bg" src="/static/img/btn_answer2.png" >
</div>
<br>
<br>
<p class="answer_tag">&nbsp;</p>
<script type="text/javascript">
    var time_admin = null;
    var all_ok = false;
    function j_toast (event) {
        // 答案提示信息弹框	
        $('.answer_tag').html(event);
        $('.answer_tag').show();
        clearTimeout(time_admin);
        time_admin = setTimeout(function() {
            $('.answer_tag').hide();
        }, 2500);
    }
    function pos_jump (e) {
        //定位
        $('html,body').animate({'scrollTop':e});
    }
    function ergodic_verification () {
        //遍历验证是否为空选/错选
        $(".do_answer_box").each(function(index,value){
            var suc_val = $(this).attr('suc');
            var must_answer = $(this).parents('.justdoit').offset().top - 24;
            if (suc_val == '') {
                //空选
                pos_jump (must_answer);
                all_ok = false;
                j_toast('必答题您还未作答，请您先回答必答题!');
                return false;
            }
            if (suc_val == 'no') {
                //错选
                pos_jump (must_answer);
                all_ok = false;
                j_toast('您提交的答案错误，请您阅读内容描述认真回答，大奖在等着你哦！');
                return false;
            }
            if (suc_val == 'yes') {
                //全部正确
                all_ok =true;
            }
        });
    }
    $('.do_answer_box p').click(function () {
        //必答题
        var cur_val = $(this).find('input').attr('answer');
        //radio选中
        $(this).addClass('cur_sel').siblings().removeClass('cur_sel');
        $(this).parent().find('input').attr('checked',false);
        $(this).find('input').attr('checked',true);
        // 选择答案是否正确
        if (cur_val == 'right') {
            j_toast('恭喜您回答正确！');
            $(this).parents('.do_answer_box').attr('suc','yes');
        } else{
            j_toast('您提交的答案错误，请您阅读内容描述认真回答！');
            $(this).parents('.do_answer_box').attr('suc','no');
        }
    });
    $('.img_bg').click(function () {
        //必答题
        ergodic_verification();//验证答案
        if (all_ok == true) {
            var data = {};
            $(':radio').each(function (i,item) {
                if (item.checked == true) {
                    data[item.name.replace("question_","")] = item.value
                }
            });
            data = {
                'answer':data,
                '_csrf':'<?=Yii::$app->request->csrfToken?>'
            };
            ajaxPost('<?=\yii\helpers\Url::to(['/site/receive-question','roster_id' => $roster_id])?>',data,function (data) {
                mui.toast(data.message);
                if (data.code == 200) {
                    window.location.href = '<?=\yii\helpers\Url::to(['/site/receive-address','roster_id' => $roster_id])?>';
                }
            });
        }
    });
</script>