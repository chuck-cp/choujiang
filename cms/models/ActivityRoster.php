<?php
namespace cms\models;

use Yii;
use cms\core\BaseModel;


/**
 * This is the model class for table "yl_activity_roster".
 *
 * @property string $id
 * @property string $activity_id 活动ID
 * @property string $member_id 用户ID
 * @property string $member_name 姓名
 * @property string $prize_code 中奖号码
 * @property string $prize_date 开奖日期
 * @property string $prize_id 奖品ID
 * @property int $prize_type 奖品类型(1、实物 2、虚拟)
 * @property string $prize_title 奖项名称
 * @property int $receive 是否领取(0、未领取 1、已领取)
 * @property string $receive_at 领取时间
 * @property string $receive_address 收货地址
 * @property string $receive_member_mobile 收货人手机号
 * @property string $receive_member_name 收货人姓名
 * @property string $receive_identity_number 收货人身份证号
 * @property string $express_name 快递名称
 * @property string $express_number 快递单号
 */
class ActivityRoster extends BaseModel
{
    public $prize_date;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_roster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'member_id', 'prize_id', 'prize_type', 'receive'], 'integer'],
            [['prize_code', 'prize_date', 'prize_title'], 'required'],
            [['prize_date', 'receive_at'], 'safe'],
            [['member_name'], 'string', 'max' => 10],
            [['prize_code'], 'string', 'max' => 30],
            [['prize_title', 'receive_identity_number', 'express_name', 'express_number'], 'string', 'max' => 50],
            [['receive_address'], 'string', 'max' => 255],
            [['receive_member_mobile', 'receive_member_name'], 'string', 'max' => 20],
            [['activity_id', 'member_id'], 'unique', 'targetAttribute' => ['activity_id', 'member_id']],
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
            'member_name' => 'Member Name',
            'prize_code' => 'Prize Code',
            'prize_date' => 'Prize Date',
            'prize_id' => 'Prize ID',
            'prize_type' => 'Prize Type',
            'prize_title' => 'Prize Title',
            'receive' => 'Receive',
            'receive_at' => 'Receive At',
            'receive_address' => 'Receive Address',
            'receive_member_mobile' => 'Receive Member Mobile',
            'receive_member_name' => 'Receive Member Name',
            'receive_identity_number' => 'Receive Identity Number',
            'express_name' => 'Express Name',
            'express_number' => 'Express Number',
        ];
    }

    //获奖管理
    public function getActivityManagementViewList($cid,$map=[]){
        $activity = ActivityCount::findOne(['id'=>$cid]);
        $model = self::find();
        $model->andWhere(['activity_id' =>$activity->activity_id,'prize_date'=>$activity->prize_date]);
        if(isset($map['prize_title']) && $map['prize_title']){
            $model->andWhere(['yl_activity_roster.prize_title' => $map['prize_title']]);
        }
        if(isset($map['member_name']) && $map['member_name']){
            $model->andFilterWhere(['like', 'yl_activity_roster.member_name', $map['member_name']]);
        }
        if(isset($map['prize_code']) && $map['prize_code']){
            $model->andWhere(['yl_activity_roster.prize_code' => $map['prize_code']]);
        }
        $page = $this->reducePage();
        $result['count'] = $model->count();
        $result['date']  = $model->limit($page['limit'])->offset($page['offset'])->select('id,activity_id,member_id,member_name,prize_id,prize_type,prize_title,prize_name,receive,receive_at,receive_address,receive_member_mobile,receive_member_name,receive_identity_number,express_name,express_number,prize_code')->asArray()->all();
//        $commandQuery = clone $model;
//        echo $commandQuery->createCommand()->getRawSql();die;
//        var_dump($result['date']);die;
        return $result;
    }

    //获奖管理导出
    public function getActivityManagementViewListExport($cid){
        $activity = ActivityCount::findOne(['id'=>$cid]);
        $model = self::find();
        $model->andWhere(['activity_id' =>$activity->activity_id,'prize_date'=>$activity->prize_date]);
        $date  = $model->select('id,member_name,prize_title,prize_name,receive_member_name,receive_identity_number,receive_member_mobile,prize_code,receive_address,receive')->asArray()->all();
        foreach ($date as $k=>$v){
            $date[$k]['id']=$v['id'];
            $date[$k]['member_name']=$v['member_name']."\t";
            $date[$k]['prize_title']=$v['prize_title'];
            $date[$k]['prize_name']=$v['prize_name'];
            $date[$k]['receive_member_name']=$v['receive_member_name'];
            $date[$k]['receive_identity_number']=$v['receive_identity_number']."\t";
            $date[$k]['receive_member_mobile']=$v['receive_member_mobile']."\t";
            $date[$k]['prize_code']=$v['prize_code'];
            $date[$k]['receive_address']=$v['receive_address'];
            $date[$k]['receive']=$v['receive']==1?'已领取':'未领取';
        }
        return $date;
    }
}
