<?php

namespace wap\models;

use yii\db\ActiveRecord;

class ActivityPrize extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_prize}}';
    }
}
