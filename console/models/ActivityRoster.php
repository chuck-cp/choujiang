<?php

namespace console\models;

use common\tools\Redis;
use yii\db\ActiveRecord;

class ActivityRoster extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_roster}}';
    }

    // 获取中奖者的数量
    public static function getPrizeNumber($activity_id, $date)
    {
        // 中一等奖的数据
        $firstModel = ActivityRoster::find()->where(['activity_id' => $activity_id ,'prize_title' => '一等奖'])->select('member_id,count(*) as number')->groupBy('member_id')->asArray()->all();
        $resultFirstPrize = [];
        $resultPrize = [];
        $resultMember = [];
        if ($firstModel) {
            foreach ($firstModel as $roster) {
                $resultFirstPrize[$roster['member_id']] = $roster['number'];
            }
        }
        // 每个用户中奖数量和每个奖项中奖数量
        $rosterModel = ActivityRoster::find()->where(['activity_id' => $activity_id ,'prize_date' => $date])->select('prize_id,member_id,prize_title')->asArray()->all();
        if (!empty($rosterModel)) {
            foreach ($rosterModel as $roster) {
                $resultMember[$roster['member_id']] = isset($resultMember[$roster['member_id']]) ? $resultMember[$roster['member_id']] + 1 : 1;
                $resultPrize[$roster['prize_id']] = isset($resultPrize[$roster['prize_id']]) ? $resultPrize[$roster['prize_id']] + 1 : 1;
            }
        }
        return [$resultPrize,$resultMember,$resultFirstPrize];
    }
}
