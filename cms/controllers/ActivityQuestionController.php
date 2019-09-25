<?php
namespace cms\controllers;

use cms\core\BaseController;
use cms\models\ActivityQuestion;
class ActivityQuestionController extends BaseController
{
    public function actionIndex()
    {
       if(\Yii::$app->request->isAjax) {
           $activityQuestionModel = new ActivityQuestion();
           $map = \Yii::$app->request->get();
           return $this->returnJson(0,$activityQuestionModel->getActivityQuestionList($map));
       }
       return $this->render('index');
    }

    public function actionCreate(){
        if(\Yii::$app->request->isAjax) {
            $activityQuestionModel = new ActivityQuestion();
            $map = \Yii::$app->request->get();
            return $this->returnJson(0,$activityQuestionModel->getActivityQuestionList($map));
        }
        return $this->render('create');
    }

    //添加问题
    public function actionCreateAdd()
    {
        $map = \Yii::$app->request->post();
        $mapkey = array_keys($map['data']);
        $model = new ActivityQuestion();
        $model->title = $map['data']['title'];
        $answer = [];
//        $model->answer = rtrim($map['data']['answer1'].','.$map['data']['answer2'].','.$map['data']['answer3'].','.$map['data']['answer4']);
        if(!empty($map['data']['answer1'])){
            $answer[] = $map['data']['answer1'];
        }
        if(!empty($map['data']['answer2'])){
            $answer[] = $map['data']['answer2'];
        }
        if(!empty($map['data']['answer3'])){
            $answer[] = $map['data']['answer3'];
        }
        if(!empty($map['data']['answer4'])){
            $answer[] = $map['data']['answer4'];
        }
        $model->answer = implode(',',$answer);
        foreach ($mapkey as $key=>$value){
            if(strstr($value,'correct_answer')){
                $correct_answer[] = $map['data'][$value];
            }
        }
        foreach ($correct_answer as $ka =>$va){
            if(!empty($map['data']['answer'.$va])){
                $correct_answer_array[] = $map['data']['answer'.$va];
            }
        }
        $model->correct_answer = implode(',',$correct_answer_array);
        $model->description = $map['data']['description'];
        $model->select_type = count($correct_answer_array)>1?'2':'1';
        $model->question_type = $map['data']['question_type'];
        $model->prize_code_number = $map['data']['prize_code_number'];
        $model->is_activity = $map['data']['is_activity'];
        $model->is_prize = $map['data']['is_prize'];
        if($model->save()){
            return json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'添加失败']);
        }
    }


    public function actionUpdate($id)
    {
        $model = ActivityQuestion::findOne(['id'=>$id]);
        $model->answer = explode(',',$model->answer);
        $correct_answer = explode(',',$model->correct_answer);
        foreach ($model->answer as $key=>$value){
            if (in_array($value,$correct_answer)){
                $correct_answer_key[] = $key;
            }
        }
        $model->correct_answer = $correct_answer_key;
        return $this->render('update',[
            'model'=>$model,
        ]);
    }

    public function actionUpdateAdd()
    {
        $map= \Yii::$app->request->post();
        $mapkey = array_keys($map['data']);
        $model = ActivityQuestion::findOne(['id'=>$map['data']['id']]);
        $model->title = $map['data']['title'];
//        $model->answer = $map['data']['answer1'].','.$map['data']['answer2'].','.$map['data']['answer3'].','.$map['data']['answer4'];
        $answer = [];
        if(!empty($map['data']['answer1'])){
            $answer[] = $map['data']['answer1'];
        }
        if(!empty($map['data']['answer2'])){
            $answer[] = $map['data']['answer2'];
        }
        if(!empty($map['data']['answer3'])){
            $answer[] = $map['data']['answer3'];
        }
        if(!empty($map['data']['answer4'])){
            $answer[] = $map['data']['answer4'];
        }
        $model->answer = implode(',',$answer);
        foreach ($mapkey as $key=>$value){
            if(strstr($value,'correct_answer')){
                $correct_answer[] = $map['data'][$value];
            }
        }
        foreach ($correct_answer as $ka =>$va){
            if(!empty($map['data']['answer'.$va])){
                $correct_answer_array[] = $map['data']['answer'.$va];
            }
        }
        $model->correct_answer = implode(',',$correct_answer_array);
        $model->description = $map['data']['description'];
        $model->select_type = count($correct_answer_array)>1?'2':'1';
        $model->question_type = $map['data']['question_type'];
        $model->prize_code_number = $map['data']['prize_code_number'];
        $model->is_activity = $map['data']['is_activity'];
        $model->is_prize = $map['data']['is_prize'];
        if($model->save()){
            return json_encode(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'修改失败']);
        }
    }


}
