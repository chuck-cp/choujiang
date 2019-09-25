<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => '抽奖活动管理系统',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'cms\controllers',
    'language' =>'zh-CN',
    'components' => [
        'user' => [
            'identityClass' => 'cms\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-cms', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'cms',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/error/app.log',
                    'logVars' => [],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','trace'],
                    'logFile' => '@app/runtime/logs/info/app.log',
                    'logVars' => [],
                ],
            ],
        ],
    ],
    'params' => $params,
];
