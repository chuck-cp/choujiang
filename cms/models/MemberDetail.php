<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;
/**
 * This is the model class for table "yl_member_detail".
 *
 * @property string $id
 * @property string $member_id 用户ID
 * @property string $activity_id 活动ID
 * @property string $activity_title 活动名称
 * @property string $grant_style 获取方式
 * @property string $prize_id 奖品ID
 * @property string $prize_code 抽奖码
 * @property string $prize_title 所中奖项
 * @property string $prize_name 奖品名称
 * @property string $prize_date 开奖日期
 * @property string $create_at 参与时间
 */
class MemberDetail extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_member_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'activity_id', 'prize_id', 'prize_code'], 'integer'],
            [['activity_title', 'grant_style'], 'required'],
            [['prize_date', 'create_at'], 'safe'],
            [['activity_title', 'grant_style'], 'string', 'max' => 100],
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
            'member_id' => 'Member ID',
            'activity_id' => 'Activity ID',
            'activity_title' => 'Activity Title',
            'grant_style' => 'Grant Style',
            'prize_id' => 'Prize ID',
            'prize_code' => 'Prize Code',
            'prize_title' => 'Prize Title',
            'prize_name' => 'Prize Name',
            'prize_date' => 'Prize Date',
            'create_at' => 'Create At',
        ];
    }

    public function getMemberDatailList($member_id,$map=[])
    {
        $model = self::find();
        $model->andWhere(['member_id' =>$member_id]);
        if(isset($map['prize_code']) && $map['prize_code']){
            $model->andWhere(['prize_code' => $map['prize_code']]);
        }
        if(isset($map['prize_title']) && $map['prize_title'] && $map['prize_title']!=='请选择所中奖项'){
            $model->andWhere(['prize_title' => $map['prize_title']]);
        }
        if(isset($map['activity_title']) && $map['activity_title']){
            $model->andFilterWhere(['like', 'activity_title', $map['activity_title']]);
        }
        $page = $this->reducePage();
        $result['count'] = $model->count();
        $commandQuery = clone $model;
        //echo $commandQuery->createCommand()->getRawSql();
        $result['date'] = $model->limit($page['limit'])->offset($page['offset'])->select('id,create_at,activity_title,prize_code,grant_style,prize_title')->asArray()->all();
        return $result;
    }

    public function getActivityPartakeView($id){
        $model = self::find()->joinWith('member',false);;
        $model->andWhere(['activity_id' =>$id]);
        $page = $this->reducePage();
        $result['count'] = $model->count();
        //$commandQuery = clone $model;
        //echo $commandQuery->createCommand()->getRawSql();
        $result['date'] = $model->limit($page['limit'])->offset($page['offset'])->select('yl_member_detail.id as did,yl_member_detail.create_at,yl_member_detail.member_number,yl_member.from,yl_member_detail.prize_code,yl_member_detail.grant_style')->asArray()->all();
        return $result;
    }

    public function getMember()
    {
        return $this->hasOne(Member::className(),['id'=>'member_id']);
    }
}
