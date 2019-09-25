<?php

namespace wap\models;

use common\tools\Globle;
use common\tools\Redis;
use common\tools\System;
use yii\db\ActiveRecord;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;

class Activity extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity}}';
    }


    // 获取目前正在进行的活动
    public function getUnderwayActivity()
    {
        $activityData = Redis::getInstance()->get('activity_underway');
        if (empty($activityData)) {
            $activityData = self::find()->where(['status' => 1])->select('id,status,first_date,is_must,is_choice,title,subtitle,prize_time,first_date')->asArray()->one();
            if ($activityData) {
                $activityData['activity_start_at'] = strtotime($activityData['first_date'] . System::convertPrizeTime($activityData['prize_time']));
                Redis::getInstance()->set('activity_underway',json_encode($activityData));
            }
        } else {
            $activityData = json_decode($activityData,true);
        }
        return $activityData;
    }

    public static function getUnderwayActivityId()
    {
        $activityData = (new Activity())->getUnderwayActivity();
        if (!empty($activityData)) {
            return $activityData['id'];
        }
        return 0;
    }

    // 获取活动数据
    public function getActivityData($activity_id)
    {
        $activityData = Redis::getInstance()->get('activity:'.$activity_id);
        if (empty($activityData)) {
            $activityData = self::find()->where(['id' => $activity_id])->select('id,status,first_date,is_must,is_choice,title,subtitle,prize_time')->asArray()->one();
            if ($activityData) {
                Redis::getInstance()->set('activity:'.$activity_id,json_encode($activityData));
            }
        } else {
            $activityData = json_decode($activityData,true);
        }
        return $activityData;
    }

    /*
     * 发放中奖码
     * @param activity_id int 活动ID
     * @param member_id string 邀请人的编号
     * @param friend_name string 被邀请人的姓名
     * @param friend_name int 被邀请人的微信唯一ID
     * @param grant_style int 中奖码类型(0、回答必答题 1、回答选答题 2、好友打开)
     * @param prize_code string 中奖码
     * */
    public static function grantPrizeCode($activity_id,$member_id,$grant_style,$friend_name = '',$friend_id = '', $prize_code = '')
    {
        return Redis::createTask(System::redisKey(0),[
            'grant_style' => $grant_style,
            'activity_id' => $activity_id,
            'friend_name' => $friend_name,
            'friend_id' => $friend_id,
            'member_id' => $member_id,
            'prize_code' => $prize_code,
        ]);
    }
}
