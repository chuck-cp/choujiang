<?php

namespace console\models;

use yii\db\ActiveRecord;

class ActivityCount extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_count}}';
    }
}
