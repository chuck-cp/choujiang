<?php

namespace console\models;

use yii\db\ActiveRecord;

class Member extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%member}}';
    }

    public static function getMobileById($id)
    {
        $memberModel = Member::find()->where(['id' => $id])->select('mobile')->asArray()->one();
        if (!empty($memberModel)) {
            return $memberModel['mobile'];
        }
    }

    public static function getIdByNumber($number)
    {
        $memberModel = Member::find()->where(['number' => $number])->select('id')->asArray()->one();
        if (!empty($memberModel)) {
            return $memberModel['id'];
        }
    }
}
