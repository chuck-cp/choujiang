<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;


/**
 * This is the model class for table "yl_activity_prize".
 *
 * @property string $id
 * @property string $activity_id 活动ID
 * @property string $prize_title 奖项名称
 * @property string $prize_number 奖品数量
 * @property string $prize_name 奖品名称
 * @property int $prize_type 奖品类型(1、实物 2、虚拟)
 */
class ActivityPrize extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_prize';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'prize_number', 'prize_type'], 'integer'],
            [['prize_title', 'prize_name'], 'required'],
            [['prize_title', 'prize_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'prize_title' => 'Prize Title',
            'prize_number' => 'Prize Number',
            'prize_name' => 'Prize Name',
            'prize_type' => 'Prize Type',
        ];
    }
}
