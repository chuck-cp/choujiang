<?php

namespace wap\models;

use common\tools\Cookie;
use common\tools\Redis;
use yii\db\ActiveRecord;

class MemberQuestion extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%member_question}}';
    }

    // 判断我是否答过题
    public static function isAnswer($activity_id, $roster_id = 0)
    {
        $key = Cookie::get('member_id');
        if ($roster_id) {
            $key .= "_{$roster_id}";
        } else {
            $key .= "_".date('Y-m-d');
        }
        return Redis::getInstance()->SISMEMBER("activity_answer_question:{$activity_id}",$key);
    }

    // 判断某人是否答过题
    public static function isAnswerByMemberId($activity_id, $member_id)
    {
        $member_id = $member_id . '_' . date('Y-m-d');
        return Redis::getInstance()->SISMEMBER("activity_answer_question:{$activity_id}",$member_id);
    }
}
