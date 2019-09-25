<?php
namespace  wap\controllers;

use common\tools\Globle;
use common\tools\System;
use wap\models\Activity;
use wap\models\Member;

class TestController extends \yii\web\Controller
{



    public function actionA()
    {
        return $this->render('a');
    }

    // 发送验证码
    public function actionValidate()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array('wwvpaldo123', $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $echoStr;
        }
    }
}