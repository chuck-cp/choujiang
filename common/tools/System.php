<?php
namespace common\tools;

use Yii;

class System
{
    // 查询用户领奖后的菜单
    public static function getMemberPrizeTitle($prize_type)
    {
        if ($prize_type == Globle::PRIZE_OBJECT) {
            return '查看奖品寄送进度';
        }
        return '查看奖品详情';
    }

    // 获取快递公司对应的KEY
    public static function getExpressKey($express_name)
    {
        $data = [
            '韵达快递' => 'yunda',
            '申通快递' => 'shentong',
            '圆通速递' => 'yuantong',
            '邮政快递包裹' => 'youzhengguonei',
            '中通快递' => 'zhongtong',
            '顺丰速运' => 'shunfeng',
            '百世快递' => 'huitongkuaidi',
            '京东物流' => 'jd',
            '天天快递' => 'tiantian',
            'EMS' => 'ems',
            '德邦' => 'debangwuliu'
        ];
        return $data[$express_name] ?? '';
    }

    // 获取物流进度
    public static function getExpress($express_name, $express_number, $mobile)
    {
        $key = 'sTETdDlG7862';
        $customer = '962DF8D566B912E8565D8AECA4A925FE';
        $param = array (
            'com' => $express_name,
            'num' => $express_number,
            'phone' => $mobile,				//手机号
            'from' => '',				//出发地城市
            'to' => '',					//目的地城市
            'resultv2' => '1'			//开启行政区域解析
        );
        //请求参数
        $post_data = array();
        $post_data["customer"] = $customer;
        $post_data["param"] = json_encode($param);
        $sign = md5($post_data["param"].$key.$post_data["customer"]);
        $post_data["sign"] = strtoupper($sign);

        $url = 'http://poll.kuaidi100.com/poll/query.do';	//实时查询请求地址

        $params = "";
        foreach ($post_data as $k=>$v) {
            $params .= "$k=".urlencode($v)."&";		//默认UTF-8编码格式
        }
        $post_data = substr($params, 0, -1);

        //发送post请求
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $result = json_decode($result,true);
        if (isset($result['message']) && $result['message'] == 'ok') {
            return $result['data'];
        }
        return [];
    }

    // 获取设备类型
    public static function getDeviceType()
    {
        $ug = $_SERVER['HTTP_USER_AGENT'];
        if(stripos($ug,'MicroMessenger')){
            return 'wechat';
        }else if(strpos($ug, 'Android')){
            return 'android';
        } else if(strpos($ug, 'iPhone') || strpos($ug, 'iPad')){
            return "ios";
        }
        return 'other';
    }

    public static function getAnswerKey($key)
    {
        $data = [
            'A','B','C','D','E','F','G','H','K'
        ];
        return $data[$key] ?? $key;
    }

    public static function convertPrizeTime($time,$type = 1) {
        if ($type == 1) {
            return $time == 1 ? '09:00' : '14:00';
        } else {
            return $time == 1 ? 9 : 14;
        }
    }

    // 跳转
    public static function redirect($url)
    {
        if ($url == '/') {
            $url = 'https://choujiang.1818lao.com';
        }
        \Yii::$app->response->redirect($url)->send();
        exit;
    }

    // 获取日期
    public static function date($format = 'Y-m-d H:i:s')
    {
        return date($format);
    }

    // 获取GET数据
    public static function get($f, $default = '')
    {
        $data = $_GET[$f] ?? $default;
        return strip_tags(trim($data));
    }

    // 获取GET数据
    public static function post($f, $default = '')
    {
        $data = $_POST[$f] ?? $default;
        if (is_array($data)) {
            return $data;
        }
        return strip_tags(trim($data));
    }

   // 返回JSON数据
    public static function returnJson($message = '',$code = Globle::SUCCESS, $data = []) {
        return json_encode([
           'code' => $code,
           'data' => $data,
           'message' => $message
        ]);
    }

    // 生成获奖码
    public static function generatePrizeCode()
    {
        $key = 'generate_prize_code:'.date('Y-m-d');
        $rand_number = '0A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0U1V2W3S4Y5Z';
        $result = '19' . date('md');
        for ($i = 0; $i < 4; $i++) {
            $m = mt_rand(0,51);
            $result .= $rand_number[$m];
        }
        if (Redis::getInstance()->SISMEMBER($key, $result)) {
            return self::generatePrizeCode();
        } else {
            Redis::getInstance()->sadd($key, $result);
        }
        return $result;
    }

    // 生成随机数
    public static function randNumber()
    {
        return random_int(100000,999999);
    }

    // 验证验证码
    public static function verifyMessage($mobile,$verify)
    {
        if (Redis::getInstance(2)->get("verify:{$mobile}") == $verify) {
            Redis::getInstance(2)->del("verify:{$mobile}");
            return true;
        }
        return false;
    }

    // 验证手机号
    public static function checkMobileFormat($mobile)
    {
        $regex = '/^(1)[3-9]\\d{9}$/';
        return preg_match($regex, $mobile);
    }

    // 发送验证码
    public static function sendMessage($mobile,$token)
    {
        $mobileType = self::checkMobileFormat($mobile);
        if(!$mobileType){
            return ['手机号格式不正确',Globle::ERROR];
        }
        if(Redis::getInstance(2)->sismember('send_message_black_list',$token)){
            return ['该手机号已被加入黑名单',Globle::ERROR];
        }
        if (Redis::getInstance(2)->get("send_message_mobile_verify:{$mobile}")) {
            return ['请勿重复发送',Globle::ERROR];
        }
        # 发送信息
        $verify = self::randNumber();
        $content = "【一把一把捞】您的手机验证码是{$verify}，请于5分钟内输入";
        $result = Redis::getInstance(1)->rpush('json_list_send_message',json_encode([
            'mobile'=> $mobile,
            'content' => $content,
        ]));
        if($result){
            # 30秒内一个手机号只能发送一次
            Redis::getInstance(2)->set("send_message_mobile_verify:{$mobile}",1,30);
            # 记录发送的内容,5分钟内有效
            Redis::getInstance(2)->set("verify:{$mobile}",$verify,300);
            # 发送成功后计算发送的数量,用于判断是否把该用户加入黑名单
            $sendNumber = Redis::getInstance(2)->INCR("message:".$token);
            if($sendNumber >= 50){
                Redis::getInstance(2)->sadd("send_message_black_list",$token);
            }
            return ['发送成功',Globle::SUCCESS];
        }
        return ['发送失败',Globle::ERROR];
    }

    // 验证APP端的登陆状态是否正确
    public static function verifyAppLoginStatus($token, $mobile, $device_number) {
        return  md5('__#@:'. $device_number . 'hd1818laocomAPP' . $mobile) == $token;
    }

    // 验证AccessToken是否正确
    public static function verifyAccessToken($access_token) {
        $mobile = Cookie::get('mobile');
        $member_id = Cookie::get('member_id');
        $from = Cookie::get('from');
        if (empty($mobile)) {
            return false;
        }
        return md5('__#@:'. $mobile . 'hd1818laocom ' . $member_id . '112' . $from) == $access_token;
    }

    // 生成AccessToken
    public static function generateAccessToken($mobile,$member_id,$from)
    {
        return md5('__#@:'. $mobile . 'hd1818laocom ' . $member_id . '112' . $from);
    }

    // 生成PublicToken
    public static function generatePublicToken($content)
    {
        return md5('__#@:'. $content . 'hd1818laocom0112');
    }

    // 验证AccessToken是否正确
    public static function verifyPublicToken($content, $token) {

        return md5('__#@:'. $content . 'hd1818laocom0112') == $token;
    }

    // 发送http请求
    public static function curl($url, $method = 'GET', $data = '' ,$encrypt = 0, $header = [])
    {
        $header = ['Content-Type:application/json'];
        if($encrypt == 1){
            $data = ["paramPo" => ["param" => Yii::$app->openssl->encode(json_encode($data))]];
            $data = json_encode($data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($method == 'POST'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        if($data){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT,3);
        curl_setopt($ch, CURLOPT_HEADER,0);
        $result = curl_exec($ch);
        if($encrypt == 1){
            $result = \Yii::$app->openssl->decode($result);
            $result = json_decode($result,true);
        }
        curl_close($ch);
        return $result;
    }

    // 获取系统中redis的Key
    public static function redisKey($type,$params = [])
    {
        if (!is_array($params)) {
            $params = [$params];
        }
        $key = [
            'grant_prize_code_list',                       // 发放抽奖码队列
            'activity_prize_code_set:{0}:{1}',                   // 这个活动中的所有抽奖码
            'friend_grant_prize_code:{0}',                   // 标记被邀请人是否点击过链接
            'activity_member_prize_code_number_set:{0}',    // 我一共获得多少个抽奖码
            'member_prize_number:{0}',                // 我一共中了多少次奖
            'grant_prize_code_middleware_list',                       // 发放抽奖码中奖键
        ];
        $resultKey = $key[$type];
        if ($params) {
            foreach ($params as $key => $value) {
                $resultKey = str_replace("{{$key}}",$value,$resultKey);
            }
        }
        return $resultKey;
    }

    /*
     * 同步数据到一把一把捞
     * @param type int 同步类型(1、注册 2、领取现金 3、领取购物款)
     * */
    public static function SyncData($type, $data)
    {
        if ($type == 1) {
            $url = "http://app.1818lao.com/ws/v1/activityWs/registerOrLogin";
        } else if ($type == 2) {
            $url = "http://app.1818lao.com/ws/v1/activityWs/updateCashAmount";
        } else {
            $url = "http://app.1818lao.com/ws/v1/activityWs/updateGwkAmount";
        }
//        $result = self::curl($url,'POST',$data,1);
//        if (isset($result['message']) && $result['message'] == 'success') {
//            return true;
//        }
        return Redis::getInstance(1)->rpush("call_back_url_list",json_encode([
            'url' => $url,
            'data' => $data,
            'method' => 'POST',
            'encrypt' => 1
        ]));
    }
    /**
     * @param $date
     * @param bool $year
     * @param bool $word
     * @return bool|string
     */
    public static function judgeDate($date, $word){
        if(!$date){
            return false;
        }
        $a = date("Y",strtotime($date));
        $b = date("m",strtotime($date));
        $d = date("d",strtotime($date));
        if($word){
            return $a.'年'.$b.'月';
        }
        return $a.'-'.$b.'-'.$d;
    }

}
