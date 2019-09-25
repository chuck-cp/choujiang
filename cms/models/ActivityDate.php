<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;


/**
 * This is the model class for table "yl_activity_date".
 *
 * @property string $id
 * @property string $activity_id 活动标题
 * @property string $prize_date 开奖日期
 */
class ActivityDate extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_date';
    }

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'prize_date' => 'Prize Date',
        ];
    }
}
