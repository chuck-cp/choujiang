<?php

namespace wap\models;

use common\tools\Cookie;
use common\tools\Redis;
use common\tools\System;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class MemberDetail extends ActiveRecord
{
    public $page;
    public static function tableName()
    {
        return '{{%member_detail}}';
    }
    private function dealTime($day){
        $min = ' 00:00:00';
        $max = ' 23:59:59';
        $yestoday = date("Y-m-d",strtotime($day." day"));
        return ['and',['>','create_at',$yestoday.$min],['<=','create_at',$yestoday.$max]];
    }
    // 获取我的本期抽奖码
    public function getMemberPrizeCode($activity_id)
    {
        $condition = ['member_id' => Cookie::get('member_id'), 'activity_id' => $activity_id];
        $yestodayCondition = $this->dealTime(0);
        $beforeyesCondition = $this->dealTime(-1);
        return [
            'today' => MemberDetail::find()->select('prize_date,create_at,prize_code,prize_title,prize_name')->where($condition)->andWhere($yestodayCondition)->orderBy('create_at DESC')->asArray()->all(),
            'yestoday' => MemberDetail::find()->select('prize_date,create_at,prize_code,prize_title,prize_name')->where($condition)->andWhere($beforeyesCondition)->orderBy('create_at DESC')->asArray()->all(),
        ];
    }

    // 我是否给我的好友增加抽奖码
    public static function isGrant($activity_id,$friend_id,$member_number)
    {
        return Redis::getInstance()->hexists(System::redisKey(2,$activity_id),$friend_id.'_'.$member_number.'_'.date('Y-m-d'));
    }

    // 获取我的历史抽奖记录  Activity::getUnderwayActivityId()
    public function getMemberHistoryCode($dt)
    {
        $rq = [];
        if($dt){
            $rq = ['and',['<=', 'create_at', $dt.' 23:59:59'],['>=', 'create_at', $dt.' 00:00:00']];
        }else{
            $rq = ['<=', 'create_at', date('Y-m-d',time()).' 23:59:59'];
        }
        #$memberModel = MemberDetail::find()->select('prize_code,prize_title,create_at,activity_id')->where(['and',['member_id' => Cookie::get('member_id')], ['<=', 'create_at', date('Y-m-d',time()).' 23:59:59']])->orderBy('create_at DESC')->asArray()->all();
        $memberModel = MemberDetail::find()->where(['and',['member_id' => Cookie::get('member_id')], $rq]);
        if (empty($memberModel)) {
            return [];
        }
        $pagination = new Pagination([
            'totalCount' => $memberModel->count(),
        ]);
        $pagination->pageSize = 6;
        $pagination->validatePage = false;
        $data = $memberModel->select('prize_code,prize_title,create_at,activity_id')->limit($pagination->limit)->offset($pagination->offset)->orderBy('create_at DESC')->asArray()->all();
        $re = [];
        if(!empty($data)){
            $data[0]['month'] = System::judgeDate($data[0]['create_at'],false);
            foreach ($data as $k => $v){
                if($k > 0){
                    if($this->getYearMonth($v['create_at']) !== $this->getYearMonth($data[$k-1]['create_at'])){
                        $data[$k]['month'] = System::judgeDate($v['create_at'], false);
                    }else{
                        $data[$k]['month'] = '';
                    }
                }
            }
            //foreach ($data)
        }
        //p($resultData);
        return $data;
    }
    /*
    * 获取某日期的年月
    */
    private function getYearMonth($date){
        return date('Y-m', strtotime($date));
    }
}
