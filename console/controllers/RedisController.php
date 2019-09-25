<?php

namespace console\controllers;


use common\tools\Redis;

class RedisController extends \yii\console\Controller
{

    /*
     * 定期清理过期的redis数据
     */
    public function actionClean(){
        Redis::getInstance()->del('generate_prize_code:'.date('Y-m-d',strtotime('-1 day')));
        $data = Redis::getInstance(2)->keys('message:*');
        foreach($data as $value){
            Redis::getInstance(2)->del($value);
        }
    }
}
