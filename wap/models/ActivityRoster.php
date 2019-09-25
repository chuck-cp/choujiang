<?php

namespace wap\models;

use common\tools\Cookie;
use common\tools\Globle;
use common\tools\Redis;
use common\tools\System;
use yii\db\ActiveRecord;
use yii\db\Exception;

class ActivityRoster extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_roster}}';
    }

    // 获取我的奖品
    public function getMemberPrize()
    {
        return self::find()->where(['member_id' => \common\tools\Cookie::get('member_id')])->orderBy('id desc')->asArray()->all();
    }

    // 更新收货地址
    public function updateAddress()
    {
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $result = ActivityRoster::updateAll(['receive' => 1,'receive_at' => System::date(),'receive_address' => System::post('receive_address'),'receive_member_mobile' => System::post('receive_member_mobile'),'receive_member_name' => System::post('receive_member_name'),'receive_identity_number' => System::post('receive_identity_number')],['id' => $this->id, 'receive' => 0]);
            if (!$result) {
                return ['请勿重复提交',Globle::ERROR];
            }
            ActivityCount::updateAllCounters(['receive_prize_number' => 1],['activity_id' => $this->activity_id, 'prize_id' => $this->prize_id]);
            Activity::updateAllCounters(['receive_prize_number' => 1],['id' => $this->activity_id]);
            $dbTrans->commit();
            return ['领取成功',Globle::SUCCESS];
        } catch (\Throwable $e) {
            $dbTrans->rollBack();
            \Yii::error($e->getMessage());
            return ['奖品领取失败',Globle::ERROR];
        }
    }

    // 判断是否领取过奖品
    public function isReceive()
    {
        return $this->receive == 1;
    }


    /*
     * 领取现金
     * @param int type 奖品类型(1、现金 2、购物券)
     * */
    public function receiveBonus($type)
    {
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $result = ActivityRoster::updateAll(['receive' => 1,'receive_at' => System::date()],['id' => $this->id, 'receive' => 0]);
            if (!$result) {
                return ['请勿重复提交',Globle::ERROR];
            }
            ActivityCount::updateAllCounters(['receive_prize_number' => 1],['activity_id' => $this->activity_id, 'prize_id' => $this->prize_id]);
            Activity::updateAllCounters(['receive_prize_number' => 1],['id' => $this->activity_id]);
            if ($type == 2) {
                ActivityRoster::updateAll(['receive_prize_type' => 3],['id' => $this->id]);
                MemberDetail::updateAll(['receive_prize_type' => 3],['prize_code' => $this->prize_code]);
                if (!System::SyncData(Globle::SYNC_TYPE_RECEIVE_BONUS,['phone' => Cookie::get('mobile'), 'type' => 2, 'cashAmount' => $this->prize_coupon, 'winNum' => $this->id, 'oriAmount' => $this->prize_name])) {
                    throw new Exception("同步数据失败");
                }
            } else {
                ActivityRoster::updateAll(['receive_prize_type' => 2],['id' => $this->id]);
                MemberDetail::updateAll(['receive_prize_type' => 2],['prize_code' => $this->prize_code]);
                if (!System::SyncData(Globle::SYNC_TYPE_RECEIVE_PRIZE,['phone' => Cookie::get('mobile'), 'type' => 2, 'cashAmount' => $this->prize_name, 'winNum' => $this->id])) {
                    throw new Exception("同步数据失败");
                }
            }
            $dbTrans->commit();
            return ['领取成功',Globle::SUCCESS];
        } catch (\Throwable $e) {
            $dbTrans->rollBack();
            \Yii::error($e->getMessage());
            return ['奖品领取失败',Globle::ERROR];
        }
    }

    // 获取快递记录
    public function getExpress()
    {
        $result = [
            'activity_id' => $this->activity_id,
            'prize_name' => $this->prize_name,
            'prize_type' => $this->prize_type,
            'prize_title' => $this->prize_title,
            'receive' => $this->receive,
            'express_name' => $this->express_name,
            'express_number' => $this->express_number,
            'express_data' => '',
            'customer_service_telephone' => ActivityConfig::getConfig('customer_service_telephone')
        ];
        if ($this->express_number) {
            $result['express_data'] = System::getExpress(System::getExpressKey($this->express_name), $this->express_number, $this->receive_member_mobile);
        }
        return $result;
    }

    // 获取中奖名单
    public function getPrizeRoster($prize_date)
    {
        if (empty($prize_date)) {
            return []
;        }
        $redis_key = 'activity_prize_roster:' . $prize_date;
        $roster = Redis::getInstance()->get($redis_key);
        if ($roster) {
            return json_decode($roster,true);
        }
        $roster = self::find()->where(['prize_date' => $prize_date])->select('prize_title,prize_code')->asArray()->all();
        if ($roster) {
            $resultData = [];
            foreach ($roster as $key => $value) {
                $resultData[$value['prize_title']][] = $value['prize_code'];
            }
            Redis::getInstance()->set($redis_key,json_encode($resultData));
            return $resultData;
        }
    }

    public function getActivity()
    {
        return $this->hasOne(Activity::className(),['id' => 'activity_id']);
    }
}
