<?php

namespace console\controllers;

use common\tools\Globle;
use common\tools\Redis;
use common\tools\System;
use console\models\Activity;
use console\models\ActivityRoster;
use console\models\MemberDetail;
use yii\console\Controller;

class PrizeController extends Controller
{

    /*
     * 更新点击量
     * */
    public function actionUpdateBrowseNumber()
    {
        $activityModel = new Activity();
        $activityModel->updateBrowseNumber();
    }

    /*
     * 检测活动的状态
     * 每天0点执行一次
     * */
    public function actionActivityStatus()
    {
        $activityModel = new Activity();
        $activityModel->checkStatus();
    }

    /*
     * 将抽奖码写入抽奖池
     * */
//    public function actionGrantMiddleware()
//    {
//        $redis_key = System::redisKey(5);
//        while (True) {
//            try {
//                if (date('H') < 3) {
//                    sleep(60);
//                    continue;
//                }
//                $data = Redis::getInstance(1)->rpop($redis_key);
//                if(empty($data)){
//                    sleep(3);
//                    continue;
//                }
//                \Yii::error($data,'grant');
//                $prize_data = json_decode($data,true);
//                Redis::getInstance()->sadd(System::redisKey(1,[$prize_data['activity_id']]),$prize_data['prize_code']);
//            } catch (\Exception $e) {
//                \Yii::error($e->getMessage(),'grant');
//                Redis::getInstance(1)->rpush($redis_key.'_failed',$data);
//            }
//        }
//    }

    /*
     * 发放奖牌
     * 队列:长期在后台运行
     * */
    public function actionGrant()
    {
        $activityModel = new Activity();
        while (True) {
            try {
                $data = Redis::getInstance(1)->rpop(System::redisKey(0));
//                $data = '{"grant_style":"2","activity_id":"5","friend_name":"","friend_id":"","member_id":"52","prize_code":"19090450O7","time":1567586773,"token":"d85e58c0f47ad6a3240e091562a913ba"}';
                if(empty($data)){
                    sleep(1);
                    continue;
                }
                \Yii::$app->db->open();
                $activityModel->grantPrizeCode($data);
                \Yii::$app->db->close();
            } catch (\Exception $e) {
                \Yii::error($e->getMessage(),'grant');
            }
        }
    }

    /*
     * 抽奖
     * 每天1点执行一次
     * */
    public function actionExtract()
    {
        $activityModel = new Activity();
        $activityModel->extractPrize();
    }

    /*
     * 回调
     * 队列:长期在后台运行
     * */
    public function actionUrl()
    {
//        $data = '{"url":"http:\/\/app.1818lao.com\/ws\/v1\/activityWs\/updateGwkAmount","data":{"phone":"15617536282","type":2,"cashAmount":"150","winNum":1239,"oriAmount":"100"},"method":"POST","encrypt":1}';
//         $data = '{"url":"http:\/\/app.1818lao.com\/ws\/v1\/activityWs\/registerOrLogin","data":{"phone":15800000525,"registerSource":"choujiang"},"method":"POST","encrypt":1}';
//        $data = '{"url":"http:\/\/app.1818lao.com\/ws\/v1\/activityWs\/registerOrLogin","data":{"phone":"15811103076"},"method":"POST","encrypt":1}';
//        $data = '{"url":"http:\/\/app.1818lao.com\/ws\/v1\/activityWs\/updateCashAmount","data":{"phone":"15811103076","type":1,"cashAmount":"100","winNum":405},"method":"POST","encrypt":1}';
//        $data = '{"url":"http:\/\/app.1818lao.com\/ws\/v1\/activityWs\/updateCashAmount","data":{"phone":"18810861738","type":1,"cashAmount":"100","winNum":413},"method":"POST","encrypt":1}';
//          $data = '{"url":"http://app.1818lao.com/ws/v1/activityWs/updateGwkAmount","data":{"phone":"18600918319","type":2,"cashAmount":"130","winNum":1024,"oriAmount":"100"},"method":"POST","encrypt":1}';
//        $data = json_decode($data,true);
//        $result = System::curl($data['url'],$data['method'],$data['data'],$data['encrypt']);
//        print_r($result);
//          exit;
        while (True) {
            try {
                $urlData = Redis::getInstance(1)->rpop('call_back_url_list');
                if(empty($urlData)){
                    sleep(1);
                    continue;
                }
                \Yii::info($urlData,'url');
                $data = json_decode($urlData,true);
                $result = System::curl($data['url'],$data['method'],$data['data'],$data['encrypt']);
                if (isset($result['message']) && $result['message'] == 'success') {
                    \Yii::info("[success]" . $data['url'],'url');
                } else {
                    \Yii::info("[ERROR]" . json_encode($result) . $data['url'],'url');
                    Redis::getInstance(1)->rpush("call_back_url_list_failed", $urlData);
                }
            } catch (\Exception $e) {
                Redis::getInstance(1)->rpush("call_back_url_list_failed", $urlData);
                \Yii::info($e->getMessage(),'url');
            }
        }
    }

    public function actionTestUrl()
    {
        $rosterModel = ActivityRoster::find()->where(['receive' => 1,'receive_prize_type' => [2,3]])->asArray()->all();
        foreach ($rosterModel as $roster) {
            if ($roster['receive_prize_type'] == 2) {
                $url = "http://app.1818lao.com/ws/v1/activityWs/updateCashAmount";
                $data = ['phone' => $roster['member_name'], 'type' => 2, 'cashAmount' => $roster['prize_name'], 'winNum' => $roster['id']];
            } else {
                $url = "http://app.1818lao.com/ws/v1/activityWs/updateGwkAmount";
                $data = ['phone' => $roster['member_name'], 'type' => 2, 'cashAmount' => $roster['prize_coupon'], 'winNum' => $roster['id'], 'oriAmount' => $roster['prize_name']];
            }
            $result = System::curl($url,'POST',$data,1);
            print_r($url);
            print_r($data);
            print_r($result);
        }
    }
    /*
     * 回调错误恢复
     * 10分钟执行一次
     * */
    public function actionFailed()
    {
        $failed_keys = [
            'call_back_url_list_failed',
//            'grant_prize_code_middleware_list_failed',
            'grant_prize_code_list_failed'
        ];
        $keys = [
            'call_back_url_list',
//            'grant_prize_code_middleware_list',
            'grant_prize_code_list'
        ];
        foreach ($failed_keys as $k => $key) {
            $urlData = Redis::getInstance(1)->lrange($key,0,-1);
            foreach ($urlData as $value) {
                try {
                    Redis::getInstance(1)->rpush($keys[$k], $value);
                    Redis::getInstance(1)->lrem($key, $value, 0);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
}