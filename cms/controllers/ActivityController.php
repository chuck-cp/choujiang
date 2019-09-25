<?php
namespace cms\controllers;
use cms\core\BaseController;
use cms\models\Activity;
use cms\models\ActivityCount;
use cms\models\ActivityPrize;
use cms\models\ActivityRoster;
use cms\models\MemberDetail;
use xplqcloud\cos\Api;
class ActivityController extends BaseController
{
   public function actionIndex()
   {
       if(\Yii::$app->request->isAjax) {
           $activityModel = new Activity();
           $map= \Yii::$app->request->get();
           return $this->returnJson(0,$activityModel->getActivityDataList($map));
       }
       return $this->render('index');
   }

    /**
     * 新增活动
     * @return string
     * @throws \yii\db\Exception
     */
   public function actionCreate(){
       if($post= \Yii::$app->request->post()) {
           $activityModel = new Activity();
           return $activityModel->getCreateActivity($post);
       }
       return $this->render('create');
   }

    /**
     * 活动修改
     * @param $id
     * @return string
     * @throws \yii\db\Exception
     */
   public function actionUpdate($id){
       if($post= \Yii::$app->request->post()) {
           $activityModel = new Activity();
           return $activityModel->getUpdateActivity($id,$post);
       }
       return $this->render('update',[
           'id'=>$id,
           'model'=>Activity::findOne(['id'=>$id]),
           'prizeModel'=>ActivityPrize::find()->where(['activity_id'=>$id])->asArray()->all(),
       ]);
   }

    /**
     * 删除奖项
     * @return string
     */
   public function actionDelPrize(){
       if($post= \Yii::$app->request->post()) {
           if(ActivityPrize::deleteAll(['id'=>$post['prize_id']])){
               return $this->returnJson(0);
           }
           return $this->returnJson(400);
       }
   }

    /**
     * 发布活动
     * @return string
     */
   public function actionStateOperation(){
       if(\Yii::$app->request->isAjax) {
           $map= \Yii::$app->request->post();
           return $this->returnJson(Activity::getStateOperationById($map['ids'],$map['status']));
       }
   }

    /**
     * 活动详情
     * @param $id
     * @return string
     */
   public function actionActivityView($id){
       return $this->render('activity-view',[
           'id'=>$id,
           'model'=>Activity::findOne(['id'=>$id]),
           'prizeModel'=>ActivityPrize::find()->where(['activity_id'=>$id])->asArray()->all(),
       ]);
   }

    /**
     * 参与详情
     * @param $id
     * @return string
     */
   public function actionPartakeView($id){
       if(\Yii::$app->request->isAjax) {
           $MemberDetailModel = new MemberDetail();
           return $this->returnJson(0,$MemberDetailModel->getActivityPartakeView($id));
       }
       return $this->render('partake-view',[
           'id'=>$id
       ]);
   }


    //获奖管理
    public function actionManagement()
    {
        if(\Yii::$app->request->isAjax) {
            $activityCModel = new ActivityCount();
            $map= \Yii::$app->request->get();
            return $this->returnJson(0,$activityCModel->getActivityManagementlist($map));
        }
        return $this->render('management');
    }
    //获奖管理详情页
    public function actionManagementView($cid)
    {
        if(\Yii::$app->request->isAjax) {
            $activityRModel = new ActivityRoster();
            $map= \Yii::$app->request->get();
            return $this->returnJson(0,$activityRModel->getActivityManagementViewList($cid,$map));
        }
        return $this->render('management-view',[
            'cid'=>$cid,
        ]);
    }


    //获奖管理详情页导出
    public function actionManagementViewExport($cid)
    {
        $activityRModel = new ActivityRoster();
        $data = $activityRModel->getActivityManagementViewListExport($cid);
        $title =['id','获奖人用户名','所获奖项','奖品名称','获奖人真实姓名','身份证号','手机号','获奖码','收货地址','领奖状态'];
        $file_name = 'table.csv';
        $this->Getcsv($data,$title,$file_name);
    }
    
    //发奖寄快递
    public function actionAward()
    {
        $map= \Yii::$app->request->post();
        $res = ActivityRoster::updateAll(['express_name'=>$map['express_name'],'express_number'=>$map['express_number']],['id'=>$map['id']]);
        if($res){
            return json_encode(['code'=>1,'msg'=>'发货成功！']);
        }else{
            return json_encode(['code'=>2,'msg'=>'发货失败！']);
        }
    }

    public function actionUploadImg($imgid){
        return $this->render('upload-img',[
            'imgid'=>$imgid
        ]);
    }

    public function actionImg(){
        $File =   $_FILES['file'];
        $ext=pathinfo($File['name']);
        $cosApi = new Api(\Yii::$app->params['COS_CONFIG']);
        $dstpath = '/img/luckdraw/'.date('ym').'/'.time().'.'.$ext['extension'];//上传的文件路径
        $uploadRet= $cosApi->upload(\Yii::$app->params['BUCKET'],$File['tmp_name'],$dstpath);
        if($uploadRet['code']==0){
            return json_encode(['code'=>0,'access_url'=>$uploadRet['data']['access_url']]);
        }else{
            return $this->returnJson(400);
        }
    }

    /**
     * 活动数据统计
     * @return string
     */
    public function actionActivityCount(){
        $activityModel = new Activity();
        if(\Yii::$app->request->isAjax) {
            return $this->returnJson(0,$activityModel->getActivityDataList());
        }
        return $this->render('activity-count',[
            'dataCount'=>$activityModel->getActivityCount()
        ]);
    }

    public function actionActivityCountView($activity_id){
        $model = new ActivityCount();
        list($countArray,$title,$idarr) = $model->getActivtionCountView($activity_id);
        return $this->render('activity-count-view',[
            'countArray'=>$countArray,
            'title'=>$title,
            'idarr'=>$idarr,
        ]);
    }
}
