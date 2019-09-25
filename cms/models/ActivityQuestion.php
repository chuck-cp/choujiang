<?php

namespace cms\models;

use Yii;
use cms\core\BaseModel;
/**
 * This is the model class for table "yl_activity_question".
 *
 * @property string $id
 * @property string $title 问题标题
 * @property string $answer 所有答案(多个以逗号分割)
 * @property string $correct_answer 正确答案
 * @property string $description 问题描述
 * @property int $select_type 类型(1、单选 2、多选)
 * @property int $question_type 题型(1、必答题 2、选答题)
 * @property int $prize_code_number 获得中奖码数量
 * @property int $is_activity 是否在活动页显示(1、显示)
 * @property int $is_prize 是否在领奖品页显示(1、显示)
 */
class ActivityQuestion extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yl_activity_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'answer', 'correct_answer'], 'required'],
            [['select_type', 'question_type', 'prize_code_number', 'is_activity', 'is_prize'], 'integer'],
            [['title', 'correct_answer'], 'string', 'max' => 100],
            [['answer', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'answer' => 'Answer',
            'correct_answer' => 'Correct Answer',
            'description' => 'Description',
            'select_type' => 'Select Type',
            'question_type' => 'Question Type',
            'prize_code_number' => 'Prize Code Number',
            'is_activity' => 'Is Activity',
            'is_prize' => 'Is Prize',
        ];
    }

    public function getActivityQuestionList($map=[])
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
        $result['date'] = $model->limit($page['limit'])->offset($page['offset'])->orderBy('id desc')->asArray()->all();
        return $result;
    }
}
