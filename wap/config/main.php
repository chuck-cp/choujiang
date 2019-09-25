<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php')
);

return [
    'id' => '抽奖系统',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'wap\controllers',
    'language' =>'zh-CN',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing'=>false,
            'showScriptName' => false,
        ],
        'request' => [
            'cookieValidationKey' => 'n9DMLNimmb9SEZCAoN1d8XtHkrjTlQfG',
        ],
        'session' => [
            'name' => 'wap',
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
