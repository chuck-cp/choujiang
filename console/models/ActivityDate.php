<?php

namespace console\models;

use yii\db\ActiveRecord;

class ActivityDate extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_date}}';
    }
}
