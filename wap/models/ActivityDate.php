<?php

namespace wap\models;

use common\tools\Redis;
use common\tools\System;
use yii\db\ActiveRecord;

class ActivityDate extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_date}}';
    }

    public static function getPrizeDate()
    {
        $date = date('Y-m-d');
        $prize_date = ActivityDate::find()->select('activity_id,prize_date')->where(['<=','prize_date',$date])->orderBy('prize_date desc')->asArray()->all();
        if (!empty($prize_date)) {
            $day = date('H');
            if ($prize_date[0]['prize_date'] == $date && $day < 14) {
                $activityData = (new Activity())->getActivityData($prize_date[0]['activity_id']);
                if (!isset($activityData['prize_time'])) {
                    $activityData['prize_time'] = 1;
                }
                if ($day < System::convertPrizeTime($activityData['prize_time'],2)) {
                    unset($prize_date[0]);
                }
            }
            return array_column($prize_date,'prize_date');
        }
        return [];
    }

    public static function getDates(){
        $data = self::find()->where()->select('prize_data')->asArray()->all();
        return $data;
    }
}
