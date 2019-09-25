<?php

namespace common\tools;
use Yii;

class Redis
{
    protected static $instance = null;
    public function __construct()
    {
        if (!extension_loaded('redis')) {
            throw new \BadFunctionCallException('not support: redis');
        }
        $redisConfig = Yii::$app->redis;
        self::$instance = new \Redis();
        self::$instance->connect($redisConfig->hostname,$redisConfig->port);
        if(isset($redisConfig->password)){
            self::$instance->auth($redisConfig->password);
        }
    }
    private function __clone(){}
    public static function getInstance($db=0)
    {
        if (!is_object(self::$instance)) {
            new self();
        }
        self::$instance->select($db);
        return self::$instance;
    }

    public static function createTask($key,$value) {
        $value['time'] = time();
        $value['token'] = System::generatePublicToken($value['time']);
        return self::getInstance(1)->rpush($key,json_encode($value));
    }
}
