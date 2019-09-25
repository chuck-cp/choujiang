<?php
namespace common\tools;

class Globle
{
    const SUCCESS = 200;
    const ERROR = 0;
    const GRANT_PRIZE_CODE_BY_MUST_QUESTION = 1; //  通过必答题获得抽奖码
    const GRANT_PRIZE_CODE_BY_CHOICE_QUESTION = 2; // 通过选答题获得抽奖码
    const GRANT_PRIZE_CODE_BY_INVITE_FRIEND = 3; // 通过邀请好友获得抽奖码
    const QUESTION_MUST = 1; // 必答题
    const QUESTION_CHOICE = 2; // 选答题
    const QUESTION_SINGLE = 1; // 单选题
    const QUESTION_MULTIPLE = 2; // 多选题
    const ACTIVITY_INDEX_PAGE = 1; // 参加活动答题页面
    const ACTIVITY_PRIZE_PAGE = 2; // 领奖答题页面
    const PRIZE_OBJECT = 1;         // 实物的奖品
    const PRIZE_INVENT = 2;        // 虚拟的奖品
    const SYNC_TYPE_REGISTER = 1;    // 注册后同步给一把一把捞
    const SYNC_TYPE_RECEIVE_PRIZE = 2;    // 领取现金后同步给一把一把捞
    const SYNC_TYPE_RECEIVE_BONUS = 3;    // 领取优惠劵后同步给一把一把捞

    public static function redisKey()
    {

    }
}