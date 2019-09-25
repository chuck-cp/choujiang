<?php

namespace wap\models;

use common\tools\Globle;
use common\tools\System;
use yii\db\ActiveRecord;
use yii\db\Exception;

class Member extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%member}}';
    }

    // 登陆
    public function login($mobile)
    {
        $mobile = (int)$mobile;
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $memberModel = self::find()->where(['mobile' => $mobile])->select('id')->asArray()->one();
            if ($memberModel) {
                return $memberModel['id'];
            }
            $this->mobile = $mobile;
            $this->save();
            if (!System::SyncData(Globle::SYNC_TYPE_REGISTER,['phone' => $mobile,"registerSource" => "choujiang"])) {
                throw new Exception("同步数据失败");
            }
            $dbTrans->commit();
            return $this->id;
        } catch (Exception $e) {
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            print_r($e->getMessage());exit;
        }

    }
}
