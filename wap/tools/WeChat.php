<?php
namespace wap\tools;
use common\tools\Cookie;
use common\tools\Redis;
use common\tools\System;
use Yii;

class WeChat
{
    protected function getUri()
    {
        return urlencode('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]);
    }

    protected function authorize()
    {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.Yii::$app->params['wx_app_id'].'&redirect_uri='.$this->getUri().'&response_type=code&scope=snsapi_base&state=wx#wechat_redirect';
        header("Location:".$url);
        exit;
    }

    protected function getCode()
    {
        return \Yii::$app->request->get('code');
    }

    protected function getOpenId()
    {
        $code = $this->getCode();
        if (empty($code)) {
            $this->authorize();
        }
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.Yii::$app->params['wx_app_id'].'&secret='. Yii::$app->params['wx_secret'] .'&code='.$code.'&grant_type=authorization_code';
        $result = System::curl($url);
        return json_decode($result,true);
    }

    public function getAccessToken()
    {
        $access_token = Redis::getInstance()->get('wechat_access_token');
        if ($access_token) {
            return $access_token;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".Yii::$app->params['wx_app_id']."&secret=".Yii::$app->params['wx_secret'];
        $result = System::curl($url);
        $result = json_decode($result,true);
        Redis::getInstance()->set('wechat_access_token',$result['access_token'],3600);
        return $result['access_token'];
    }

    public function getUser()
    {
        $openData = $this->getOpenId();
        if (!isset($openData['openid'])){
            return [
                'open_id' => '',
                'username' => ''
            ];
        }
        $open_id = $openData['openid'];
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=". Cookie::get('wechat_access_token')."&openid={$open_id}&lang=zh_CN";
        $result = System::curl($url);
        $result = json_decode($result,true);
        return [
            'open_id' => $open_id,
            'username' => $result['nickname'] ?? ''
        ];
    }

    public static function getSignature()
    {
        $wechat_jsapi_ticket = Cookie::get('wechat_jsapi_ticket');
        if (empty($wechat_jsapi_ticket)) {
            return ['','',''];
        }
        $noncestr = System::randNumber();
        $timestamp = time();
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $str = "jsapi_ticket=".$wechat_jsapi_ticket ."&noncestr={$noncestr}&timestamp={$timestamp}&url={$url}";
        return [$noncestr,$timestamp,sha1($str)];
    }

    public function getJsapiTicket()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=". Cookie::get('wechat_access_token') ."&type=jsapi";
        $result = System::curl($url);
        $result = json_decode($result,true);
        return $result['ticket'] ?? '';
    }
}