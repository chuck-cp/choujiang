<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "yl_member_log".
 *
 * @property string $id
 * @property string $member_id 用户ID
 * @property int $status 变更类型(1、正常 2、无资格)
 * @property string $descition 变更原因
 * @property string $create_at 参与时间
 */
class MemberLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_member_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'status'], 'integer'],
            [['descition'], 'required'],
            [['create_at'], 'safe'],
            [['descition'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'status' => 'Status',
            'descition' => 'Descition',
            'create_at' => 'Create At',
        ];
    }

    /**
     * 获取资格详情
     * @param $id
     * @return array|string|\yii\db\ActiveRecord[]
     */
    public function getMemberLogDataById($member_id){
        $menmberData = self::find()->where(['member_id'=>$member_id])->asArray()->all();
        if(empty($menmberData)){
           return [];
        }
        return $menmberData;
    }
}
