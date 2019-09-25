<?php

namespace wap\models;

use common\tools\Cookie;
use common\tools\Globle;
use common\tools\Redis;
use common\tools\System;
use yii\db\ActiveRecord;
use yii\db\Exception;

class ActivityQuestion extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_question}}';
    }


    /*
     * 答题
     * @param string is_choice 是否显示选答题
     * @param string is_must 是否显示必答题
     * @param json answer 答案
     * @param string activity_id 活动ID
     * @param string prize_type 奖品类型
     * @param string roster_id 中奖记录ID
     * @param string page 答题页面(1、活动页 2、领奖页面)
     * @param string prize_id 奖品ID
     * */
    public function answerQuestion($is_choice,$is_must,$answer,$activity_id,$prize_type = 1,$roster_id = 0,$page = 1,$prize_id = 0)
    {
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $resultPrizeCode = [];
            if (empty($answer)) {
                return [Globle::ERROR,'答案不能为空',''];
            }
            $question = $this->getActiveQuestion($is_choice,$is_must,$page);
            // 创建答题记录并增加活动参与人数
            $questionModel = new MemberQuestion();
            $questionModel->activity_id = $activity_id;
            $questionModel->member_id = Cookie::get('member_id');
            $questionModel->roster_id = $roster_id;
            $questionModel->date = date('Y-m-d');
            $questionModel->save();
            if ($page == Globle::ACTIVITY_INDEX_PAGE) {
                Activity::updateAllCounters(['member_number' => 1],['id' => $activity_id]);
                Member::updateAllCounters(['activity_number' => 1],['id' => Cookie::get('member_id')]);
            }
            if ($page == Globle::ACTIVITY_INDEX_PAGE) {
                foreach ($question as $key => $value) {
                    if (!isset($answer[$value['id']])) {
                        $answer[$value['id']] = '';
                    }
                    if ($answer[$value['id']] != $value['correct_answer']) {
                        if ($value['question_type'] == Globle::QUESTION_MUST) {
                            return [Globle::ERROR, '答案错误', $value['id']];
                        }
                    } else {
                        for ($i = 0; $i < $value['prize_code_number']; $i++) {
                            $resultPrizeCode[] = ['prize_code' => System::generatePrizeCode(), 'question_type' => $value['question_type']];
                        }
                    }
                }
            } else {
                foreach ($question as $key => $value) {
                    if (!isset($answer[$value['id']]) || $answer[$value['id']] != $value['correct_answer']) {
                        return [Globle::ERROR, '答案错误', $value['id']];
                    }
                }
            }
            if ($resultPrizeCode) {
                foreach ($resultPrizeCode as $value) {
                    Activity::grantPrizeCode($activity_id,Cookie::get('member_id'),$value['question_type'],'','',$value['prize_code']);
                }
                $resultPrizeCode = array_column($resultPrizeCode,"prize_code");
                $resultPrizeCode = implode(",",$resultPrizeCode);
            }
            if ($roster_id) {
                Redis::getInstance()->sadd("activity_answer_question:{$activity_id}",Cookie::get('member_id')."_{$roster_id}" ."_". date('Y-m-d'));
            } else {
                Redis::getInstance()->sadd("activity_answer_question:{$activity_id}",Cookie::get('member_id') ."_". date('Y-m-d'));
            }
            $dbTrans->commit();
            return [Globle::SUCCESS,'问题回答正确',$resultPrizeCode];
        } catch (\Throwable $e) {
            $dbTrans->rollBack();
            \Yii::error($e->getMessage() . $e->getLine());
            return [Globle::ERROR, $e->getMessage() . $e->getLine(),''];
        }
    }

    /*
     * 获取题目
     * @param string is_choice 是否显示选答题
     * @param string is_must 是否显示必答题
     * @param string page 答题页面(1、活动页 2、领奖页面)
     * */
    public function getActiveQuestion($is_choice,$is_must,$page = 1)
    {
        $question_type = [];
        if ($is_choice) {
            $question_type[] = Globle::QUESTION_CHOICE;
        }
        if ($is_must) {
            $question_type[] = Globle::QUESTION_MUST;
        }
        if ($question_type) {
            $where = ['question_type' => $question_type];
        }
        if ($page == Globle::ACTIVITY_INDEX_PAGE) {
            $where['is_activity'] = 1;
        } else {
            $where['is_prize'] = 1;
        }
        return self::find()->where($where)->select('prize_code_number,id,title,answer,correct_answer,description,select_type,question_type')->orderBy('question_type asc,id asc')->asArray()->all();
    }
}
