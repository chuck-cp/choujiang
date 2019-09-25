<?php

namespace wap\models;

use common\tools\Redis;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class MemberLog extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%member_log}}';
    }
}
