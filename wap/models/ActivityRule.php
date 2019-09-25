<?php

namespace wap\models;

use common\tools\Redis;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class ActivityRule extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_rule}}';
    }

    // 获取活动规则
    public function getActivityRule($activity_id)
    {
        $redis_key = 'ACTIVITY_RULE:' . $activity_id;
        $activity_rule = Redis::getInstance()->get($redis_key);
        if ($activity_rule) {
            return $activity_rule;
        }
        $activityModel = self::find()->where(['activity_id' => $activity_id])->select('content')->asArray()->one();
        if (empty($activityModel)) {
            throw new NotFoundHttpException();
        }
        if ($activityModel && $activityModel['content']) {
            Redis::getInstance()->set($redis_key,$activityModel['content']);
            return $activityModel['content'];
        }
    }
}
