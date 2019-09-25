<?php

namespace cms\models;


use cms\core\BaseModel;
use yii\db\Expression;
class Member extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    public function getMemberList($map=[])
    {
        $model = self::find();
        if(isset($map['from']) && $map['from'] && is_numeric($map['from'])){
            $model->andWhere(['from' => $map['from']]);
        }
        if(isset($map['status']) && $map['status'] && is_numeric($map['status'])){
            $model->andWhere(['status' => $map['status']]);
        }
        if(isset($map['mobile']) && $map['mobile']){
            $model->andFilterWhere(['like', 'mobile', $map['mobile']]);
        }
        $page = $this->reducePage();
        $result['count'] = $model->count();
        $result['date'] = $model->limit($page['limit'])->offset($page['offset'])->select('id,mobile,activity_number,draw_number,from,status')->orderBy('id desc')->asArray()->all();
        return $result;
    }

    public function updateMember($name,$mobile)
    {
        if ($this->mobile != $mobile) {
            if (self::find()->where(['mobile'=>$mobile])->count()) {
                return false;
            }
        }
        $this->name = $name;
        $this->mobile = $mobile;
        return $this->save();
    }


    public function createIntegral($type, $integral, $description)
    {
        $dbTrans = \Yii::$app->db->beginTransaction();
        try{
            if (empty($integral)) {
                return false;
            }

            if ($type == 1) {
                self::updateAllCounters(['integral' => $integral], ['id' => $this->id]);
            } else {
                self::updateAll(['integral' => new Expression('integral - '.$integral)],['and', ['id' => $this->id], ['>=', 'integral', $integral]]);
            }
            if(!MemberIntegralDetail::log($this->id, $integral, $type, $description)){
                throw new \Exception('error');
            }
            $dbTrans->commit();
            return true;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            return false;
        }
    }

    public function createMember($name, $mobile, $integral)
    {
        if (self::find()->where(['mobile'=>$mobile])->count()) {
            return false;
        }
        $dbTrans = \Yii::$app->db->beginTransaction();
        try{
            $this->name = $name;
            $this->mobile = $mobile;
            $this->integral = (int)$integral;
            $this->save();
            if($this->integral > 0)
            {
                if(!MemberIntegralDetail::log($this->id,$integral)){
                    throw new \Exception('error');
                }
            }
            $dbTrans->commit();
            return true;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            return false;
        }
    }

    public function getOperationStatus($post = []){
        $dbTrans = \Yii::$app->db->beginTransaction();
        try{
            self::updateAll(['status'=>(int)$post['status']],['id'=>(int)$post['member_id']]);
            $model = new MemberLog();
            $model->member_id = (int)$post['member_id'];
            $model->status =(int)$post['status'];
            $model->descition = $post['reason'];
            $model->create_at = date('Y-m-d H:i:s');
            $model->create_user_name = \Yii::$app->user->identity->username;
            $model->save();
            $dbTrans->commit();
            return true;
        }catch (\Exception $e){
            \Yii::error($e->getMessage());
            $dbTrans->rollBack();
            return false;
        }
    }
}
