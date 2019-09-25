<?php

namespace console\models;

use common\tools\Redis;
use common\tools\System;
use yii\db\ActiveRecord;

class MemberDetail extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%member_detail}}';
    }

    // 获取我的所有中奖号码
    public static function getAllPrizeCode($activity_id,$member_id)
    {
        $memberModel = MemberDetail::find()->where(['activity_id' => $activity_id,'member_id' => $member_id])->select('prize_code')->asArray()->all();
        if (!empty($memberModel)) {
            return array_column($memberModel,'prize_code');
        }
    }

    // 根据中奖编号找到用户ID和编号获取时间
    public static function getDataByCode($prize_code)
    {
        $memberModel = MemberDetail::find()->where(['prize_code' => $prize_code])->select('member_id,create_at')->asArray()->one();
        if (!empty($memberModel)) {
            return [$memberModel['member_id'],$memberModel['create_at']];
        }
        return ['',''];
    }

    // 我是否给我的好友增加抽奖码
    public static function isGrant($activity_id, $friend_id, $member_number)
    {
        return Redis::getInstance()->hexists(System::redisKey(2,$activity_id),$friend_id.'_'.$member_number.date('Y-m-d'));
    }
}
