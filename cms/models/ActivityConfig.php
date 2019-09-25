<?php

namespace cms\models;

use Yii;
use common\libs\RedisClass;
use cms\core\BaseModel;


/**
 * This is the model class for table "yl_activity_config".
 *
 * @property string $id
 * @property string $content 问题标题
 * @property string $descition 问题描述
 */
class ActivityConfig extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'content'], 'required'],
            [['id', 'content'], 'string', 'max' => 100],
            [['descition'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'descition' => 'Descition',
        ];
    }

    public function getActivityConfig($where){
        return self::find()->where(['id'=>$where])->asArray()->all();
    }

    public function getActivityConfigUpdate($data=[]){
        $dbTrans = \Yii::$app->db->beginTransaction();
        try{
            foreach ($data['data'] as $k=>$v){
                self::updateAll(['content'=>$v],['id'=>$k]);
                RedisClass::set("system_config:".$k,$v,0);
            }
            $dbTrans->commit();
            return true;
        }catch (\Exception $e){
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            return false;
        }
    }
}
