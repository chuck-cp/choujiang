<?php
namespace cms\controllers;

use cms\core\BaseController;
use cms\models\ActivityNumberCount;
use cms\models\Member;
use cms\models\MemberLog;
use cms\models\MemberDetail;

class MemberController extends BaseController
{
   public function actionIndex()
   {
       if(\Yii::$app->request->isAjax) {
           $memberModel = new Member();
           $map = \Yii::$app->request->get();
           return $this->returnJson(0,$memberModel->getMemberList($map));
       }
       return $this->render('index');
   }

   public function actionCreate()
   {
       if($post = \Yii::$app->request->post())
       {
           $memberModel = new Member();
           $status = 0;
           if(!$memberModel->createMember($post['name'],$post['mobile'],$post['integral'])){
               $status = 400;
           }
           return $this->returnJson($status);
       }
       return $this->render('create');
   }

    public function actionUpdate($id)
    {
        $memberModel = Member::findOne($id);
        if($post = \Yii::$app->request->post())
        {
            $status = 0;
            if(!$memberModel->updateMember($post['name'],$post['mobile'])){
                $status = 400;
            }
            return $this->returnJson($status);
        }
        return $this->render('update',['model'=>$memberModel]);
    }

   public function actionIntegral($id)
   {
       $memberModel = Member::findOne($id);
       if($post = \Yii::$app->request->post())
       {
           $status = 0;
           $type = (int)$post["type"];
           $integral = (int)$post["integral"];
           $description = htmlspecialchars($post["description"]);
           if(!$memberModel->createIntegral($type, $integral, $description)) {
               $status = 400;
           }
           return $this->returnJson($status);
       }
       return $this->render('integral',[
           'model'=>$memberModel
       ]);
   }

   public function actionOperationStatus(){
       if(\Yii::$app->request->isAjax) {
           $post = \Yii::$app->request->post();
           $model = new Member();
            if($model->getOperationStatus($post)){
                return $this->returnJson(0);
            }
            return $this->returnJson(400);
       }
   }

    /**
     * 资格详情
     * @param $member_id
     * @return string
     */
   public function actionQuaView($member_id){
       $model = new MemberLog();
       $memberLogData = $model->getMemberLogDataById($member_id);
       return $this->render('qua-view',[
          'memberLogData' => $memberLogData
       ]);
   }


    /**
     * 查看详情
     * @param $member_id
     * @return string
     */
   public function actionMemberView($member_id){
       if(\Yii::$app->request->isAjax) {
           $MemberDetailModel = new MemberDetail();
           $map = \Yii::$app->request->get();
           return $this->returnJson(0,$MemberDetailModel->getMemberDatailList($member_id,$map));
       }
       return $this->render('member-view',[
           'member_id'=>$member_id
       ]);
   }

    public function actionMemberCount()
    {
        if(\Yii::$app->request->isAjax) {
            $activityNumberModel = new ActivityNumberCount();
            $map = \Yii::$app->request->get();
            return $this->returnJson(0,$activityNumberModel->getMemberCountlList($map));
        }
        $memberCount = [
            'member_number'=>0,
            'member_activity_number'=>0,
            'new_member_number'=>0,
            'new_member_activity_number'=>0,
            'total_member_activity_number'=>0,
        ];
        return $this->render('member-count',[
            'memberCount'=>$memberCount,
        ]);
    }

    public function actionMemberCountExport()
    {
        $activityNModel = new ActivityNumberCount();
        $data = $activityNModel->getActivityManagementViewListExport();
        $title =['活动ID','活动时间','注册用户数','参加活动的人数','新增注册用户','新增参加活动人数','当天参加活动的总人数'];
        $file_name = 'member.csv';
        $this->Getcsv($data,$title,$file_name);
    }
}
