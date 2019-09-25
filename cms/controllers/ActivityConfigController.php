<?php
namespace cms\controllers;

use cms\core\BaseController;
use cms\models\ActivityConfig;
class ActivityConfigController extends BaseController
{
   public function actionIndex()
   {
       $activityConfigModel = new ActivityConfig();
       if($post = \Yii::$app->request->post()){
           if($activityConfigModel->getActivityConfigUpdate($post)){
               return $this->returnJson(0);
           };
           return $this->returnJson(400);
       }
       $where = ['award_acceptance_period','customer_service_telephone','every_prize_number','issue_prize_number','maximum_winning_number','cash_to_coupon_rate'];
       $activityConfigData = $activityConfigModel->getActivityConfig($where);
       foreach($activityConfigData as $key=>$value){
           $data[$value['id']] =$value['content'];
       }
       return $this->render('index',[
           'data'=>$data,
       ]);
   }
}
