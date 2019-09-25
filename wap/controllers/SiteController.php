<?php
namespace  wap\controllers;
use common\tools\Globle;
use common\tools\Redis;
use wap\models\Activity;
use wap\models\ActivityCount;
use wap\models\ActivityDate;
use wap\models\ActivityPrize;
use wap\models\ActivityRoster;
use wap\models\ActivityQuestion;
use wap\models\ActivityRule;
use wap\models\Member;
use wap\models\MemberDetail;
use common\tools\Cookie;
use common\tools\System;
use wap\models\MemberLog;
use wap\models\MemberQuestion;
use wap\tools\WeChat;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

class SiteController extends \yii\web\Controller
{
    protected $allow_action_id = ['index','login','verify','rule','prize','error'];  // 不需要登陆就能访问的方法
    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $wechatModel = new WeChat();
            $from = System::get('from',Cookie::get('from'));
            if ($from == 'APP') {
                if (!YII_DEBUG) {
                    if (System::getDeviceType() == 'other') {
                        throw new NotFoundHttpException("请在APP或微信端打开");
                    }
                }

                $token = System::get('token');
                if ($token) {
                    Cookie::set('mobile','');
                    Cookie::set('member_id','');
                    Cookie::set('member_id','');
                    Cookie::set('activity_token','');
                    $device_number = System::get('device_number');
                    $mobile = System::get('mobile');
                    if (!System::verifyAppLoginStatus($token, $mobile, $device_number)) {
                        throw new NotFoundHttpException();
                    }
                } else {
                    $token = Cookie::get('token');
                    $device_number = Cookie::get('device_number');
                    $mobile = Cookie::get('mobile');
                    $activity_token = Cookie::get('activity_token');
                    if ($activity_token) {
                        if (!System::verifyAccessToken($activity_token)){
                            throw new NotFoundHttpException();
                        }
                    } else {
                        if (!System::verifyAppLoginStatus($token, $mobile, $device_number)) {
                            throw new NotFoundHttpException("WEB_OPEN");
                        }
                    }
                }

                Cookie::set('token',$token);
                Cookie::set('device_number',$device_number);
                Cookie::set('verify_token',System::generatePublicToken($device_number));
                Cookie::set('from','APP');
                if ($mobile) {
                    // 使用APP进入
                    $member_id = (new Member())->login($mobile);
                    Cookie::set('mobile',$mobile);
                    Cookie::set('member_id',$member_id);
                    Cookie::set('activity_token', System::generateAccessToken($mobile,$member_id,'APP'));
                }
            } else {
                if (System::getDeviceType() != 'wechat') {
                    throw new NotFoundHttpException("请在APP或微信端打开");
                }
                $wechat_access_token = Cookie::get('wechat_access_token');
                if (empty($wechat_access_token)) {
                    $wechat_access_token = $wechatModel->getAccessToken();
                    Cookie::set('wechat_access_token',$wechat_access_token,3600);
                }
                $wechat_jsapi_ticket = Cookie::get('wechat_jsapi_ticket');
                if (empty($wechat_jsapi_ticket)) {
                    $wechat_jsapi_ticket = $wechatModel->getJsapiTicket();
                    Cookie::set('wechat_jsapi_ticket',$wechat_jsapi_ticket,3600);
                }
                // 非APP进入先验证是否是微信端
                $user = $wechatModel->getUser();
                Cookie::set('from','WAP');
                Cookie::set('username',$user['username']);
                Cookie::set('open_id',$user['open_id']);
                Cookie::set('verify_token',System::generatePublicToken($user['open_id'].$user['username']));
            }
        }
        $activity_token = Cookie::get('activity_token');
        if ($activity_token) {
            // 验证TOKEN是否正确
            if (!System::verifyAccessToken($activity_token)){
                throw new NotFoundHttpException();
            }
        } else {
            // 返回首页
            if (!in_array($action->id,$this->allow_action_id)) {
                System::redirect('/');
            }
        }
        return parent::beforeAction($action);
    }


    public function actionError()
    {
        $this->layout = false;
        return $this->render('error');
    }

    /*
     * 活动首页
     * @param i int 活动ID
     * @param a string 活动ID
     * @param t string 密钥
     * @param f string 邀请人编号
     * @param o string 邀请人的微信OPEN_ID
     * */
    public function actionIndex($i = '', $t = '', $f = '', $o = '')
    {
        $activityModel = new Activity();
        if ($i) {
            $activityData = $activityModel->getActivityData($i);
        } else {
            $activityData = $activityModel->getUnderwayActivity();
        }
        if (empty($activityData) || $activityData['status'] != 1) {
            $activityData = $activityModel->getUnderwayActivity();
            return $this->render('activity-over',[
                'activity_id' => $activityData['id'] ?? 0
            ]);
        } else {
            Redis::getInstance(0)->incr("activity_browse_number:{$activityData['id']}");
            if ($t) {
                if (!System::verifyPublicToken($f . '_)' . $o . date('Ymd'),$t)) {
                    throw new NotFoundHttpException("链接已失效");
                }
                if (Cookie::get('from') == 'WAP' && $activityData['status'] == 1 && !empty($f) && MemberQuestion::isAnswerByMemberId($activityData['id'],$f) && !MemberDetail::isGrant($activityData['id'],Cookie::get('open_id'),$f)) {
                    // 来源不为空时给邀请人发放中奖码
                    // 自己给自己点击不加抽奖码
                    // 没有参与答题的也给抽奖码
                    if (empty($o) || ($o != Cookie::get('open_id'))) {
                        $activityModel::grantPrizeCode($i,$f,Globle::GRANT_PRIZE_CODE_BY_INVITE_FRIEND,Cookie::get('username'),Cookie::get('open_id'));
                    }
                }
            }
            return $this->render('activity-index',[
                'is_answer' => MemberQuestion::isAnswer($activityData['id']),
                'activity_id' => $activityData['id']
            ]);
        }
    }

    // 活动规则页面
    public function actionRule()
    {
        return $this->render('activity-rule');
    }

    // 登陆页
    public function actionLogin()
    {
        if (\Yii::$app->request->isAjax) {
            $mobile = System::get('mobile');
            $verify = System::get('verify');
            if (empty($mobile) || empty($verify)) {
                return System::returnJson('手机号或验证码不能为空',Globle::ERROR);
            }
            if (!System::verifyMessage($mobile,$verify)) {
                return System::returnJson('验证码错误',Globle::ERROR);
            }
            $memberModel = new Member();
            $member_id = $memberModel->login($mobile);
            Cookie::set('mobile',$mobile);
            Cookie::set('member_id',$member_id);
            Cookie::set('activity_token', System::generateAccessToken($mobile, $member_id, Cookie::get('from')));
            $activity_id = Activity::getUnderwayActivityId();
            return System::returnJson("登陆成功",Globle::SUCCESS,[
                'is_answer' => (int)MemberQuestion::isAnswer($activity_id),
            ]);
        }
    }

    // 答题页
    public function actionQuestion($i)
    {
        $activityModel = new Activity();
        $activityData = $activityModel->getActivityData($i);
        if ($activityData['status'] != 1) {
            if (\Yii::$app->request->isAjax) {
                return System::returnJson('活动已关闭',Globle::ERROR);
            } else {
                System::redirect(['/','i' => $i]);
            }
        }

        if (MemberQuestion::isAnswer($i)) {
            if (\Yii::$app->request->isAjax) {
                return System::returnJson('请勿重复回答',Globle::ERROR);
            } else {
                System::redirect(['/','i' => $i]);
            }
        }


        $questionModel = new ActivityQuestion();
        if (\Yii::$app->request->isAjax) {
            list($code,$message,$data) = $questionModel->answerQuestion($activityData['is_choice'],$activityData['is_must'],System::post('answer'),$i);
            return System::returnJson($message,$code,$data);
        }
        $question = $questionModel->getActiveQuestion($activityData['is_choice'],$activityData['is_must']);
        return $this->render('question',[
            'content' => $question,
            'i' => $i
        ]);
    }

    // 答题成功页面
    public function actionQuestionSuccess($i)
    {
        $activityModel = new Activity();
        $activityData = $activityModel->getActivityData($i);
        $data = explode(",",System::get('data'));
        return $this->render('question-success',[
            'i' => $i,
            'prize_date' => $activityData['first_date'],
            'data' => $data
        ]);
    }

    // 我的抽奖码
    public function actionCode()
    {
        $activityModel = new Activity();
        $activityData = $activityModel->getUnderwayActivity();
        $detailModel = new MemberDetail();
        $prizeCode = $detailModel->getMemberPrizeCode($activityData['id']);
        #p($prizeCode);
        #return $this->render('member-code',[
        return $this->render('code',[
            'date' => strtotime(date('Y-m-d')),
            'activity' => $activityData,
            'content' => $prizeCode,
        ]);
    }

    // 抽奖记录
    public function actionHistory()
    {
        $detailModel = new MemberDetail();
        $history = $detailModel->getMemberHistoryCode(\Yii::$app->request->get('date'));
        #p($history);
        if(\Yii::$app->request->isAjax){
            return json_encode(['data' => $history], true);
        }
        return $this->render('member-history');

    }

    //获取系统日期
    public function getAllDates(){
        return json_encode(ActivityDate::getDates());
    }
    // 我的奖品
    public function actionPrize()
    {
        if (empty(Cookie::get('activity_token'))) {
            System::redirect("http://m.1818lao.com/downLoad.aspx?method=downLoad&language=zh_CN");
        }
        $prizeDetail = new ActivityRoster();
        $prizeData = $prizeDetail->getMemberPrize();
        return $this->render('member-prize',[
            'content' => $prizeData
        ]);
    }



    // 中奖名单
    public function actionRoster()
    {
        $rosterModel = new ActivityRoster();
        if (\Yii::$app->request->isAjax) {
            $prizeRoster = $rosterModel->getPrizeRoster(System::get('date'));
            return System::returnJson($prizeRoster,Globle::SUCCESS);
        }
        $prizeDate = ActivityDate::getPrizeDate();
        $prizeRoster = [];
        if ($prizeDate) {
            $prizeRoster = $rosterModel->getPrizeRoster($prizeDate[0]);
        }
        if (empty($prizeDate)) {
            return $this->render('activity-roster-empty');
        } else {
            return $this->render('activity-roster',[
                'prize_date' => $prizeDate,
                'prize_roster' => $prizeRoster ?? []
            ]);
        }
    }

    // 发送验证码
    public function actionVerify()
    {
        $verify_token = Cookie::get('verify_token');
        if (Cookie::get('from') == 'APP') {
            if (!System::verifyPublicToken(Cookie::get('device_number'),$verify_token)) {
                return System::returnJson("参数错误",Globle::ERROR);
            }
        } else {
            if (!System::verifyPublicToken(Cookie::get('open_id').Cookie::get('username'),$verify_token)) {
                return System::returnJson("参数错误",Globle::ERROR);
            }
        }
        $mobile = System::get('mobile');
        list($message,$code) = System::sendMessage($mobile,$verify_token);
        return System::returnJson($message,$code);
    }



    // 领取现金或兑换购物券
    public function actionReceiveBonus($roster_id, $type)
    {
        $rosterModel = ActivityRoster::findOne(['id' => $roster_id,'member_id' => Cookie::get('member_id')]);
        if (empty($rosterModel)) {
            throw new NotFoundHttpException();
        }
        if (!MemberQuestion::isAnswer($rosterModel['activity_id'],$roster_id)) {
            if (\Yii::$app->request->isAjax) {
                return System::returnJson('请先答题',Globle::ERROR);
            } else {
                System::redirect(['site/prize']);
            }
        }
        if ($rosterModel->isReceive()) {
            return System::returnJson('您已领取礼品',Globle::ERROR);
        }
        list($message,$code) = $rosterModel->receiveBonus($type);
        return System::returnJson($message,$code);
    }

    // 领取奖品
    public function actionReceiveQuestion($roster_id)
    {
        $rosterModel = ActivityRoster::find()->joinWith('activity',true)->select('is_choice,is_must,prize_id,prize_type,activity_id,receive')->where(['yl_activity_roster.id' => $roster_id, 'member_id' => Cookie::get('member_id')])->asArray()->one();
        if (empty($rosterModel) || empty($rosterModel['prize_id'])) {
            throw new NotFoundHttpException();
        }

        if (MemberQuestion::isAnswer($rosterModel['activity_id'],$roster_id)) {
            if (\Yii::$app->request->isAjax) {
                return System::returnJson('请勿重复提交', Globle::ERROR);
            } else {
                if ($rosterModel['prize_type'] == Globle::PRIZE_OBJECT && $rosterModel['receive'] == 0) {
                    System::redirect(['/site/receive-address','roster_id' => $roster_id]);
                } else {
                    System::redirect(['/site/receive-express','roster_id' => $roster_id]);
                }
            }
        }

        $questionModel = new ActivityQuestion();
        if (\Yii::$app->request->isAjax) {
            list($code,$message) = $questionModel->answerQuestion($rosterModel['is_choice'],$rosterModel['is_must'],System::post('answer'),$rosterModel['activity_id'],$rosterModel['prize_type'],$roster_id,Globle::ACTIVITY_PRIZE_PAGE,$rosterModel['prize_id']);
            return System::returnJson($message,$code);
        }
        $question = $questionModel->getActiveQuestion($rosterModel['is_choice'],$rosterModel['is_must'],Globle::ACTIVITY_PRIZE_PAGE);
        return $this->render('receive-question',[
            'roster_id' => $roster_id,
            'content' => $question,
        ]);
    }

    // 填写收货地址
    public function actionReceiveAddress($roster_id)
    {
        $prizeDetail = ActivityRoster::findOne(['id' => $roster_id, 'member_id' => Cookie::get('member_id')]);
        if (empty($prizeDetail)) {
            throw new NotFoundHttpException();
        }

        if ($prizeDetail['prize_type'] == Globle::PRIZE_INVENT) {
            System::redirect(['/site/receive-express','roster_id' => $roster_id]);
        }

        if ($prizeDetail['receive'] == 1) {
            if (\Yii::$app->request->isAjax) {
                System::returnJson('请勿重复提交', Globle::ERROR);
            } else {
                System::redirect(['/site/receive-express','roster_id' => $roster_id]);
            }
        }

        if (\Yii::$app->request->isAjax) {
            list($message,$code) = $prizeDetail->updateAddress();
            return System::returnJson($message,$code);
        }
        return $this->render('receive-address',[
            'content' => $prizeDetail,
            'roster_id' => $roster_id
        ]);
    }

    // 物流进度
    public function actionReceiveExpress($roster_id)
    {
        $this->layout = false;
        $rosterModel = ActivityRoster::findOne(['id' => $roster_id, 'member_id' => (int)Cookie::get('member_id')]);
        if (empty($rosterModel)) {
            throw new NotFoundHttpException();
        }
        if ($rosterModel['prize_type'] == Globle::PRIZE_OBJECT) {
            $express = $rosterModel->getExpress();
            return $this->render('receive-express',[
                'content' => $express,
            ]);
        } else {
            if ($rosterModel['receive'] == 0) {
                return $this->render('receive-bonus',[
                    'content' => $rosterModel,
                    'roster_id' => $roster_id,
                ]);
            } else {
                return $this->render('receive-bonus-detail',[
                    'content' => $rosterModel,
                    'roster_id' => $roster_id
                ]);
            }
        }
    }
}