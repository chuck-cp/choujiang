<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;

/**
 * This is the model class for table "yl_activity_number_count".
 *
 * @property string $id
 * @property string $activity_id 活动统计表ID
 * @property string $prize_date 开奖时间
 * @property string $member_number 注册用户数
 * @property string $member_activity_number 参加活动的人数
 * @property string $new_member_number 新增注册用户
 * @property string $new_member_activity_number 新增参加活动人数
 * @property string $total_member_activity_number 当天参加活动的总人数
 */
class ActivityNumberCount extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_number_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'member_number', 'member_activity_number', 'new_member_number', 'new_member_activity_number', 'total_member_activity_number'], 'integer'],
            [['prize_date'], 'required'],
            [['prize_date'], 'safe'],
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
            'prize_date' => 'Prize Date',
            'member_number' => 'Member Number',
            'member_activity_number' => 'Member Activity Number',
            'new_member_number' => 'New Member Number',
            'new_member_activity_number' => 'New Member Activity Number',
            'total_member_activity_number' => 'Total Member Activity Number',
        ];
    }

    public function getMemberCountlList($map=[]){
        $model = self::find();
        if(isset($map['prize_date']) && $map['prize_date']){
            $model->andWhere(['>=','prize_date',$map['prize_date']]);
        }
        if(isset($map['prize_date_end']) && $map['prize_date_end'] ){
            $model->andWhere(['<=','prize_date',$map['prize_date_end']]);
        }
//        $commandQuery = clone $model;
//        echo $commandQuery->createCommand()->getRawSql();
//        die;
        $page = $this->reducePage();
        $result['count'] = $model->count();
        $result['date']  = $model->limit($page['limit'])->offset($page['offset'])->select('id,activity_id,prize_date,member_number,member_activity_number,new_member_number,new_member_activity_number,total_member_activity_number')->orderBy('id desc')->asArray()->all();
        return $result;
    }
}
