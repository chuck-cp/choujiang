<?php

namespace console\models;


use common\tools\Globle;
use common\tools\Redis;
use common\tools\System;
use console\models\ActivityDate;
use yii\db\ActiveRecord;
use yii\db\Exception;

class Activity extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity}}';
    }


    // 更新点击量
    public function updateBrowseNumber()
    {
        $keys = Redis::getInstance()->keys('activity_browse_number:*');
        if (empty($keys)) {
            return false;
        }
        foreach ($keys as $key) {
            try {
                $browse_number = (int)Redis::getInstance()->get($key);
                if (empty($browse_number)) {
                    continue;
                }
                $key = explode(":",$key);
                Activity::updateAll(['browse_number' => $browse_number],['id' => $key[1]]);
            } catch (\Throwable $e) {
                print_r($e->getMessage());
                \Yii::error($e->getMessage(),'app');
            }
        }
    }

    // 检测活动状态
    public function checkStatus()
    {
        \Yii::info("检测活动状态",'app');
        $activityModel = self::find()->where(['end_at' => date('Y-m-d',strtotime('-1 day')), 'status' => 1])->select('id,status,first_date,is_must,is_choice,title,subtitle,prize_time')->asArray()->all();
        if (!empty($activityModel)) {
            foreach ($activityModel as $value) {
                try {
                    $value['status'] = 2;
                    self::updateAll(['status' => 2],['id' => $value['id']]);
                    Redis::getInstance()->set('activity:' . $value['id'],json_encode($value));
                    Redis::getInstance()->del('activity_browse_number:' . $value['id']);
                    \Yii::info("活动{$value['id']}下线",'app');
                } catch (\Throwable $e) {
                    \Yii::info($e->getMessage(),'app');
                }
            }
        }
        Redis::getInstance()->set('activity_underway','');
        $activityModel = self::find()->where(['start_at' => date('Y-m-d'), 'status' => 0])->select('id,status,first_date,is_must,is_choice,title,subtitle,prize_time')->asArray()->all();
        if (!empty($activityModel)) {
            foreach ($activityModel as $value) {
                try {
                    $value['status'] = 1;
                    $value['activity_start_at'] = strtotime($value['first_date'] . System::convertPrizeTime($value['prize_time']));
                    Redis::getInstance()->set('activity_underway',json_encode($value));
                    self::updateAll(['status' => 1],['id' => $value['id']]);
                    Redis::getInstance()->set('activity:'.$value['id'],json_encode($value));
                    \Yii::info("活动{$value['id']}上线",'app');
                } catch (\Throwable $e) {
                    \Yii::info($e->getMessage(),'app');
                }

            }
        }
    }

    // 获取获取抽奖码的方式
    public function getGrantStyle($style,$friend_name = '')
    {
        if ($style == Globle::GRANT_PRIZE_CODE_BY_MUST_QUESTION) {
            $result = '回答必答题';
        } elseif ($style == Globle::GRANT_PRIZE_CODE_BY_CHOICE_QUESTION) {
            $result = '回答选答题';
        } elseif ($style == Globle::GRANT_PRIZE_CODE_BY_INVITE_FRIEND) {
            $result = $friend_name . '好友打开';
        }
        return $result;
    }

    /*
     * 发放抽奖码
     * @param prize_data json 数据
     * */
    public function grantPrizeCode($prize_data)
    {
        \Yii::info($prize_data,'grant');
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $data = json_decode($prize_data,true);
            if (!System::verifyPublicToken($data['time'],$data['token'])) {
                \Yii::info("TOKEN错误",'grant');
                return;
            }
            if (date('Ymd') != date('Ymd',$data['time'])) {
                \Yii::info("时间不对",'grant');
                return;
            }
            $member_id = $data['member_id'];
            if ($data['grant_style'] == Globle::GRANT_PRIZE_CODE_BY_INVITE_FRIEND) {
                if (empty($data['friend_id'])) {
                    \Yii::info("好友ID不能为空",'grant');
                    return;
                }
                // 判断我的朋友是否已经给我加过
                if (MemberDetail::isGrant($data['activity_id'],$data['friend_id'],$member_id)) {
                    \Yii::info("已经添加过了",'grant');
                    return;
                }
            }
            Member::updateAllCounters(['draw_number' => 1],['id' => $member_id]);
            $codeNumber = (int)Redis::getInstance()->ZSCORE(System::redisKey(3,$data['activity_id']),$member_id . '-' . date('Y-m-d'));
            $maxCodeNumber = ActivityConfig::getConfig('maximum_winning_number');
            if ($codeNumber >= $maxCodeNumber) {
                \Yii::info("已获取{$codeNumber}个中奖码,最大获取:{$maxCodeNumber}",'grant');
                return;
            }
            self::updateAllCounters(['prize_code_number' => 1],['id' => $data['activity_id']]);
            $activityModel = $this->getActivityData($data['activity_id']);
            if (empty($activityModel) || $activityModel['status'] != 1) {
                \Yii::info("活动已关闭",'grant');
                return;
            }
            $memberDetailModel = new MemberDetail();
            $memberDetailModel->member_id = $member_id;
            $memberDetailModel->friend_id = $data['friend_id'];
            $memberDetailModel->activity_id = $data['activity_id'];
            $memberDetailModel->activity_title = $activityModel['title'];
            $memberDetailModel->prize_code = empty($data['prize_code']) ? System::generatePrizeCode() : $data['prize_code'];
            $memberDetailModel->grant_style = $this->getGrantStyle($data['grant_style'], $data['friend_name']);
            $memberDetailModel->create_at = date('Y-m-d H:i:s',$data['time']);
            $memberDetailModel->save();
            // 将编号写入抽奖池
            Redis::getInstance(0)->sadd(System::redisKey(1,[$data['activity_id'],date('Y-m-d',$data['time'])]),$data['prize_code']);
            if ($data['grant_style'] == Globle::GRANT_PRIZE_CODE_BY_INVITE_FRIEND) {
                Redis::getInstance()->hSet(System::redisKey(2,$data['activity_id']),$data['friend_id'].'_'.$member_id.'_'.date('Y-m-d'),$memberDetailModel->prize_code);
                // 增加我的总抽奖码数量
                if (empty($codeNumber)) {
                    Redis::getInstance()->zAdd(System::redisKey(3,$data['activity_id']),1,$member_id.'_'.date('Y-m-d'));
                } else {
                    Redis::getInstance()->ZINCRBY(System::redisKey(3,$data['activity_id']),1,$member_id.'_'.date('Y-m-d'));
                }
            }
            \Yii::info('发放成功:' . $memberDetailModel->prize_code,'grant');
            $dbTrans->commit();
        } catch (\Throwable $e) {
            Redis::getInstance(1)->rpush("grant_prize_code_list_failed",$prize_data);
            \Yii::info($e->getMessage(),'grant');
            $dbTrans->rollBack();
        }
    }

    // 获取活动数据
    public function getActivityData($activity_id)
    {
        $activityData = Redis::getInstance()->get('activity:'.$activity_id);
        if (empty($activityData)) {
            $activityData = self::find()->where(['id' => $activity_id])->select('status,first_date,is_must,is_choice,title,subtitle,prize_time')->asArray()->one();
            Redis::getInstance()->set('activity:'.$activity_id,json_encode($activityData));
        } else {
            $activityData = json_decode($activityData,true);
        }
        return $activityData;
    }

    // 昨天要开奖的活动
    public function getPrizeActivity($date)
    {
        if ($activityModel = ActivityDate::find()->where(['prize_date' => $date])->select('activity_id')->asArray()->one()) {
            return $activityModel['activity_id'];
        }
    }

    // 抽奖
    public function extractPrize()
    {
        \Yii::info(date('Y-m-d H:i:s') . " 开始抽奖",'extract');
        $prize_date = date('Y-m-d'); // 开奖日期
        $activity_id = $this->getPrizeActivity($prize_date);
        if (empty($activity_id)) {
            \Yii::info("{$prize_date} 没有要开奖的活动",'extract');
            return;
        }
        $activityData = $this->getActivityData($activity_id);
        $prizeModel = ActivityPrize::find()->where(['activity_id' => $activity_id])->asArray()->all();
        if (empty($prizeModel)) {
            \Yii::info("活动{$activity_id}没有奖品",'extract');
            return;
        }
//        $redis_prize_key = System::redisKey(1,[$activity_id,date('Y-m-d')]);
        $redis_prize_key = System::redisKey(1,[$activity_id,date('Y-m-d',strtotime('-1 day'))]);
        if (!Redis::getInstance(1)->scard($redis_prize_key)) {
            \Yii::info('没有人参加活动,抽奖结束','extract');
            return;
        }
        # 每期活动可以获奖次数
        $every_prize_number = ActivityConfig::getConfig('every_prize_number');
        # 每天可以获奖次数
        $issue_prize_number = ActivityConfig::getConfig('issue_prize_number');
        // 获取当前抽奖的进度
        list($rosterNumber,$rosterMember,$firstRosterNumber) = ActivityRoster::getPrizeNumber($activity_id, $prize_date);
        foreach ($prizeModel as $key => $value) {
            // 初始化中奖数量
            if (!isset($rosterNumber[$value['id']])) {
                $rosterNumber[$value['id']] = 0;
            }
            // 开始抽奖
            while (true) {
                if ($rosterNumber[$value['id']] >= $value['prize_number']) {
                    \Yii::info("奖品ID:".$rosterNumber[$value['id']]."已超过发行量",'extract');
                    break;
                }
                $dbTrans = \Yii::$app->db->beginTransaction();
                try {
                    // 找出中奖者
                    $prize_code = Redis::getInstance(1)->spop($redis_prize_key);
                    if (empty($prize_code)) {
                        $dbTrans->rollBack();
                        \Yii::info('编号已用完,抽奖结束','extract');
                        break;
                    }
                    // 根据抽奖码找到用户ID和抽奖码或获得日期
                    list($member_id,$prize_code_date) = MemberDetail::getDataByCode($prize_code);
                    # 判断每天中奖的次数,大于设定次数时跳过
                    if (isset($rosterMember[$member_id]) && $rosterMember[$member_id] >= $issue_prize_number) {
                        $dbTrans->rollBack();
                        \Yii::info($prize_code . '已超过最大中奖次数' . $rosterMember[$member_id] .'>='. $issue_prize_number,'extract');
                        continue;
                    }
                    // 一个人在一期活动内中一等奖超过两次则跳过此次抽奖
                    if ($value['prize_title'] == '一等奖') {
                        if (!isset($firstRosterNumber[$member_id])) {
                            $firstRosterNumber[$member_id] = 0;
                        }
                        if ($firstRosterNumber[$member_id] > 1) {
                            \Yii::info("用户:{$member_id} 抽奖码:{$prize_code}已中过两次一等奖",'extract');
                            $dbTrans->rollBack();
                            continue;
                        }
                    }
                    // 增加中奖名单表数据
                    $cloneModel = new ActivityRoster();
                    $cloneModel->member_id = $member_id;
                    $cloneModel->member_name = Member::getMobileById($member_id);
                    $cloneModel->activity_id = $activity_id;
                    $cloneModel->activity_title = $activityData['title'];
                    $cloneModel->prize_code = $prize_code;
                    $cloneModel->prize_date = $prize_date;
                    $cloneModel->prize_time = $activityData['prize_time'];
                    $cloneModel->prize_code_date = $prize_code_date;
                    $cloneModel->prize_id = $value['id'];
                    $cloneModel->prize_type = $value['prize_type'];
                    $cloneModel->prize_time = $activityData['prize_time'];
                    $cloneModel->prize_title = $value['prize_title'];
                    $cloneModel->prize_name = $value['prize_name'];
                    $cloneModel->prize_image = $value['prize_image'];
                    if ($value['prize_type'] == Globle::PRIZE_INVENT) {
                        $cloneModel->prize_coupon = (int)($value['prize_name'] * ActivityConfig::getConfig('cash_to_coupon_rate'));
                    }
                    $cloneModel->save();
                    MemberDetail::updateAll(['prize_id' => $value['id'],'prize_title' => $value['prize_title'],'prize_name' => $value['prize_name'],'prize_date' => $prize_date],['prize_code' => $prize_code]);
                    // 增加统计表数据
                    \Yii::$app->db->createCommand(
                        "insert into yl_activity_count (activity_id,prize_id,prize_date,prize_title,prize_number) values ('{$activity_id}','{$value['id']}','{$prize_date}','{$value['prize_title']}',1) ON DUPLICATE KEY UPDATE prize_number = prize_number + 1"
                    )->execute();
                    // 增加活动表数据
                    self::updateAllCounters(['prize_number' => 1],['id' => $activity_id]);
                    // 增加每个奖项的中奖人数
                    $rosterNumber[$value['id']]++;
                    $rosterMember[$member_id] = isset($rosterMember[$member_id]) ? $rosterMember[$member_id] + 1 : 1;
                    if ($value['prize_title'] == '一等奖') {
                        $firstRosterNumber[$member_id]++;
                    }
                    \Yii::info($prize_code . '中了' . $value['prize_title'],'extract');
                    $dbTrans->commit();
                } catch (\Throwable $e) {
                    \Yii::info($e->getMessage(),'extract');
                    $dbTrans->rollBack();
                }
            }
        }
    }
}
