<?php

namespace wap\models;

use yii\db\ActiveRecord;

class ActivityCount extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_count}}';
    }

    public function getActivity()
    {
        return $this->hasOne(Activity::className(),['id' => 'activity_id']);
    }
}
