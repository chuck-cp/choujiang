<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;
use yii\db\Expression;
use cms\models\ActivityPrize;
/**
 * This is the model class for table "yl_activity".
 *
 * @property string $id
 * @property string $activity_title 活动标题
 * @property string $activity_subtitle 活动副标题
 * @property int $satus 状态(0、未发布 1、正常 2、已结束)
 * @property string $start_at 活动开始时间
 * @property string $end_at 活动结束时间
 * @property int $prize_time 开奖时间(1、上午 2、下午)
 * @property string $browse_number 浏览量
 * @property string $member_number 参与人数
 * @property string $code_number 发放的抽奖码数量
 * @property string $prize_number 获奖次数
 * @property string $receive_prize_number 领奖次数
 * @property string $prize_time_desc 中奖时间说明
 * @property string $participatory_form 参与形式
 * @property string $activity_rule 活动规则
 * @property string $activity_content 活动内容
 * @property int $is_choice 是否显示选择题(1、显示)
 * @property int $is_must 是否显示必答题(1、显示)
 */
class Activity extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * 活动管理列表
     * @param $map
     * @return mixed
     */
    public function getActivityDataList($map=[]){
        $model = self::find();
        if(isset($map['activity_id']) && $map['activity_id']){
            $model->andWhere(['id' => $map['activity_id']]);
        }
        if(isset($map['status']) && $map['status'] && is_numeric($map['status'])){
            $model->andWhere(['status' => $map['status']]);
        }
        if(isset($map['activity_title']) && $map['activity_title']){
            $model->andFilterWhere(['like', 'activity_title', $map['activity_title']]);
        }
        $commandQuery = clone $model;
        //echo $commandQuery->createCommand()->getRawSql();
        $page = $this->reducePage();
        $result['count'] = $model->count();
        $result['date']  = $model->limit($page['limit'])->offset($page['offset'])->select('id,title,start_at,end_at,first_date,browse_number,member_number,prize_number,status,prize_code_number,receive_prize_number')->orderBy('id desc')->asArray()->all();
        return $result;
    }

    public static function getStateOperationById($ids,$status){
        $ids = explode(',',$ids);
        if(self::updateAll(['status'=>$status],['id'=>$ids])!==false){
            return  0;
        }
        return 400;
    }

    //获奖管理
    public function getActivityManagementlist($map=[]){
        $model = self::find();
        if(isset($map['activity_id']) && $map['activity_id']){
            $model->andWhere(['id' => $map['activity_id']]);
        }
        if(isset($map['status']) && $map['status'] && is_numeric($map['status'])){
            $model->andWhere(['status' => $map['status']]);
        }
        if(isset($map['activity_title']) && $map['activity_title']){
            $model->andFilterWhere(['like', 'activity_title', $map['activity_title']]);
        }
        //$commandQuery = clone $model;
        //echo $commandQuery->createCommand()->getRawSql();
        $page = $this->reducePage();
        $result['count'] = $model->count();
        $result['date']  = $model->limit($page['limit'])->offset($page['offset'])->select('id,activity_title,start_at,end_at,first_date,browse_number,member_number,prize_number,status')->asArray()->all();
        //print_r($result['date']);
        return $result;
    }


    /**
     * 添加活动
     * @param $post
     * @return bool
     * @throws \yii\db\Exception
     */
    public function getCreateActivity($post){
        $keydata = array_keys($post['data']);
        foreach ($keydata as $k=>$v){
            if(strstr($v,'prize_title') ){
                $prizeArr['prize_title'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_number') ){
                $prizeArr['prize_number'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_name') ){
                $prizeArr['prize_name'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_image') ){
                $prizeArr['prize_image'][]=$post['data'][$v];
            }
        }
        $prizeArr['prize_type'] = $post['prize_type'];
        foreach ($prizeArr as $kk=>$vv){
            foreach ($vv as $k => $vvv){
                $prize[$k][$kk]=$vvv;
            }
        }
        $datas= $this->prDatea($post['data']['start_at'],$post['data']['end_at']);
        foreach($datas as $dev){
            $devs = date('Y-m-d', strtotime ("+1 day", strtotime($dev)));//开奖日期
            $dateCount = ActivityDate::find()->where(['prize_date'=>$devs])->count();
            if((int)$dateCount!==0){
                return json_encode(['code'=>'300','msg'=>$dev]);
                break;
            }
        }
        $dbTrans = \Yii::$app->db->beginTransaction();
        try{

            $activityModel = new self();
            $activityPrizeModel = new ActivityPrize();
            $activityDateModel = new ActivityDate();

            //活动表添加
            $activityModel->title = $post['data']['title'];
            $activityModel->subtitle = $post['data']['subtitle'];
            $activityModel->start_at = $post['data']['start_at'];
            $activityModel->end_at = $post['data']['end_at'];
            $activityModel->prize_time = $post['data']['prize_time'];
            $activityModel->prize_number = array_sum($prizeArr['prize_number']);
            $activityModel->is_choice = $post['data']['is_choice'];
            $activityModel->is_must = $post['data']['is_must'];
            $activityModel->first_date = date('Y-m-d', strtotime ("+1 day", strtotime($post['data']['start_at'])));
            $activityModel->save();

            //活动获奖详情添加
            foreach ($prize as $pk=>$pv){
                $activityPrizeModelClone = clone $activityPrizeModel;
                $activityPrizeModelClone->activity_id = $activityModel->id;
                $activityPrizeModelClone->prize_title = $pv['prize_title'];
                $activityPrizeModelClone->prize_number = $pv['prize_number'];
                $activityPrizeModelClone->prize_name = $pv['prize_name'];
                $activityPrizeModelClone->prize_type = $pv['prize_type'];
                $activityPrizeModelClone->prize_image =str_replace('http://pic-10043876.file.myqcloud.com/','http://f0.1818lao.com/',$pv['prize_image']);
                $activityPrizeModelClone->save();
            }
            //开奖日期添加
            foreach ($datas as $dv){
                $activityDateModelClone = clone $activityDateModel;
                $activityDateModelClone->activity_id = $activityModel->id;
                $activityDateModelClone->prize_date = date('Y-m-d', strtotime ("+1 day", strtotime($dv)));
                $activityDateModelClone->save();
            }
            $dbTrans->commit();
            return json_encode(['code'=>0]);
        }catch (\Exception $e){
            //echo $e->getMessage();
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            return json_encode(['code'=>400]);
        }
    }


    /**
     * 修改活动
     * @param $post
     * @return bool
     * @throws \yii\db\Exception
     */
    public function getUpdateActivity($id,$post){
        $keydata = array_keys($post['data']);
        foreach ($keydata as $k=>$v){
            if(strstr($v,'prize_id') ){
                $prizeArr['prize_id'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_title') ){
                $prizeArr['prize_title'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_number') ){
                $prizeArr['prize_number'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_name') ){
                $prizeArr['prize_name'][]=$post['data'][$v];
            }
            if(strstr($v,'prize_image') ){
                $prizeArr['prize_image'][]=$post['data'][$v];
            }
        }
        $prizeArr['prize_type'] = $post['prize_type'];
        foreach ($prizeArr as $kk=>$vv){
            foreach ($vv as $k => $vvv){
                $prize[$k][$kk]=$vvv;
            }
        }
        $datas= $this->prDatea($post['data']['start_at'],$post['data']['end_at']);
        foreach($datas as $dev){
            $dateCount = ActivityDate::find()->where(['and',['<>','activity_id',$id],['prize_date'=>$dev]])->count();
            if((int)$dateCount!==0){
                return json_encode(['code'=>'300','msg'=>$dev]);
                break;
            }
        }
        $dbTrans = \Yii::$app->db->beginTransaction();
        try{
            $activityModel = self::findOne(['id'=>$id]);
            $activityDateModel = new ActivityDate();
            $activityPrizeModel = new ActivityPrize();
            //活动表添加
            $activityModel->title = $post['data']['title'];
            $activityModel->subtitle = $post['data']['subtitle'];
            $activityModel->start_at = $post['data']['start_at'];
            $activityModel->end_at = $post['data']['end_at'];
            $activityModel->prize_time = $post['data']['prize_time'];
            $activityModel->prize_number = array_sum($prizeArr['prize_number']);
            $activityModel->is_choice = $post['data']['is_choice'];
            $activityModel->is_must = $post['data']['is_must'];
            $activityModel->first_date =date('Y-m-d', strtotime ("+1 day", strtotime($post['data']['start_at'])));
            $activityModel->save();

            //活动获奖详情添加
            foreach ($prize as $pk=>$pv){
                if(isset($pv['prize_id'])){
                    ActivityPrize::updateAll(['prize_title'=>$pv['prize_title'],'prize_number'=>$pv['prize_number'],'prize_name'=>$pv['prize_name'],'prize_image'=>str_replace('http://pic-10043876.file.myqcloud.com/','http://f0.1818lao.com/',$pv['prize_image']),'prize_type'=>$pv['prize_type']],['id'=>$pv['prize_id'],'activity_id'=>$id]);
                }else{
                    $activityPrizeModelClone = clone $activityPrizeModel;
                    $activityPrizeModelClone->activity_id = $id;
                    $activityPrizeModelClone->prize_title = $pv['prize_title'];
                    $activityPrizeModelClone->prize_number = $pv['prize_number'];
                    $activityPrizeModelClone->prize_name = $pv['prize_name'];
                    $activityPrizeModelClone->prize_type = $pv['prize_type'];
                    $activityPrizeModelClone->prize_image =$pv['prize_image'];
                    $activityPrizeModelClone->save();
                }
            }
            //开奖日期添加
            $activityDateModel::deleteAll(['activity_id'=>$id]);
            foreach ($datas as $dv){
                $activityDateModelClone = clone $activityDateModel;
                $activityDateModelClone->activity_id = $id;
                $activityDateModelClone->prize_date = date('Y-m-d', strtotime ("+1 day", strtotime($dv)));
                $activityDateModelClone->save();
            }
            $dbTrans->commit();
            return json_encode(['code'=>0]);
        }catch (\Exception $e){
            echo $e->getMessage();
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            return json_encode(['code'=>400]);
        }
    }

    public function getActivityCount(){
        $dataCount = [];
        $model = new self();
        $dataCount['browse_number'] = $model->find()->sum('browse_number');
        $dataCount['member_number'] = $model->find()->sum('member_number');
        $dataCount['prize_code_number'] = $model->find()->sum('prize_code_number');
        $dataCount['prize_number'] = $model->find()->sum('prize_number');
        $dataCount['receive_prize_number'] = $model->find()->sum('receive_prize_number');
        return $dataCount;
    }

    public function prDatea($start,$end){
        $dt_start = strtotime($start);
        $dt_end = strtotime($end);
        $arr = [];
        while ($dt_start<=$dt_end){
            $arr[] = date('Y-m-d',$dt_start);
            $dt_start = strtotime('+1 day',$dt_start);
        }
        return $arr;
    }

}
