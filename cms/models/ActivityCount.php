<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;

/**
 * This is the model class for table "yl_activity_count".
 *
 * @property string $id
 * @property string $activity_id 活动统计表ID
 * @property string $prize_id 奖品ID
 * @property string $prize_title 奖项名称
 * @property string $prize_number 中奖人数
 * @property string $receive_prize_number 领奖人数
 * @property string $create_at 开奖时间
 */
class ActivityCount extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'prize_id', 'prize_number', 'receive_prize_number'], 'integer'],
            [['create_at'], 'safe'],
            [['prize_title'], 'string', 'max' => 30],
            [['activity_id', 'prize_id'], 'unique', 'targetAttribute' => ['activity_id', 'prize_id']],
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
            'prize_id' => 'Prize ID',
            'prize_title' => 'Prize Title',
            'prize_number' => 'Prize Number',
            'receive_prize_number' => 'Receive Prize Number',
            'create_at' => 'Create At',
        ];
    }

    //获奖管理
    public function getActivityManagementlist($map=[]){
        $model = self::find()->joinWith('activity',false);
        if(isset($map['activity_id']) && $map['activity_id']){
            $model->andWhere(['yl_activity_count.activity_id' => $map['activity_id']]);
        }
        if(isset($map['activity_title']) && $map['activity_title']){
            $model->andFilterWhere(['like', 'yl_activity.title', $map['activity_title']]);
        }
        if(isset($map['prize_number']) && $map['prize_number']){
            $model->andWhere(['yl_activity_count.prize_number' => $map['prize_number']]);
        }
        $page = $this->reducePage();
        $result['count'] = $model->count();
//        $result['date']  = $model->limit($page['limit'])->offset($page['offset'])->select('yl_activity_count.id as cid, yl_activity_count.activity_id, yl_activity_count.prize_date,yl_activity_count.prize_number, yl_activity_count.receive_prize_number,yl_activity.id as aid,yl_activity.title,yl_activity.start_at,yl_activity.end_at')->orderBy('cid desc')->asArray()->all();
        $result['date']  = $model->limit($page['limit'])->offset($page['offset'])->select('yl_activity_count.id as cid, yl_activity_count.activity_id, yl_activity_count.prize_date,SUM(yl_activity_count.prize_number) as prize_number, SUM(yl_activity_count.receive_prize_number) as receive_prize_number,yl_activity.id as aid,yl_activity.title,yl_activity.start_at,yl_activity.end_at')->groupBy('yl_activity_count.activity_id,yl_activity_count.prize_date')->orderBy('cid desc')->asArray()->all();
//        $commandQuery = clone $model;
//        echo $commandQuery->createCommand()->getRawSql();die;
//        var_dump($result['date']);
        return $result;
    }


    public function getActivtionCountView($activity_id){
        $CountData = self::find()->where(['activity_id'=>$activity_id])->asArray()->all();
        if(empty($CountData)){
            return '';
        }
        $CountDataOne['prize_date'] = array_unique(array_column($CountData,'prize_date'));
        $CountDataOne['prize_id'] = array_unique(array_column($CountData,'prize_id'));
        $prize_title = array_unique(array_column($CountData,'prize_title'));
        foreach ($CountDataOne['prize_date'] as $v1){
            foreach ($CountData as $k2=>$v2 ){
                if($v1==$v2['prize_date']){
                    $arr[$v1][$v2['prize_id']]['prize_number']= $v2['prize_number'];
                    $arr2[$v1]['prize_id'][]= $v2['prize_id'];
                    $arr[$v1][$v2['prize_id']]['receive_prize_number']= $v2['receive_prize_number'];
                }
            }
        }
        foreach ($CountDataOne['prize_date'] as $v2){
            foreach ($arr[$v2] as $k4=>$v4){
                $arr3[$v2]['prize_number'.$k4]= $v4['prize_number'];
                $arr3[$v2]['receive_prize_number'.$k4]= $v4['receive_prize_number'];
            }
        }
        foreach ($prize_title as $vt){
            $titleArr[]=$vt.'获奖人数';
            $titleArr[]=$vt.'领奖人数';
        }
        foreach ($CountDataOne['prize_id'] as $idv){
            $idarr[]='prize_number'.$idv;
            $idarr[]='receive_prize_number'.$idv;
        }
        return [$arr3,$titleArr,$idarr];
    }
    public function getActivity()
    {
        return $this->hasOne(Activity::className(),['id'=>'activity_id']);
    }
}
