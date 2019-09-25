<?php

namespace wap\models;

use common\tools\Redis;
use yii\db\ActiveRecord;

class ActivityConfig extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_config}}';
    }

    public static function getConfig($id)
    {
        $redis_key = 'system_config:'.$id;
        $config = Redis::getInstance(0)->get($redis_key);
        if ($config) {
            return $config;
        }
        $configModel = ActivityConfig::find()->where(['id' => $id])->select('content')->asArray()->one();
        if (!empty($configModel)) {
            Redis::getInstance(0)->set($redis_key,$configModel['content']);
            return $configModel['content'];
        }
    }
}
