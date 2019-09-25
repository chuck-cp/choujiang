<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "yl_member_question".
 *
 * @property string $id
 * @property string $activity_id 活动ID
 * @property string $member_id 用户ID
 * @property string $roster_id 中奖表的ID(不填写则是首次加入活动的答题)
 * @property string $answer 答案
 */
class MemberQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_member_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'member_id', 'roster_id'], 'integer'],
            [['answer'], 'string', 'max' => 100],
            [['activity_id', 'member_id', 'roster_id'], 'unique', 'targetAttribute' => ['activity_id', 'member_id', 'roster_id']],
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
            'member_id' => 'Member ID',
            'roster_id' => 'Roster ID',
            'answer' => 'Answer',
        ];
    }
}
