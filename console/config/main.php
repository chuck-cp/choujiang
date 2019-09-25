<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'));

return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'openssl' => [
            'class' => 'flmencrypt\encrypt\Openssl',
            'secret' => "liuyunqiang@lx100$#365#$",
            'iv' => "01234567",
        ],
        'log' => [
            'traceLevel' => 0,
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['app'],
                    'exportInterval' => 1,
                    'logFile' => '@app/runtime/logs/error/app.log',
                    'logVars'=>[],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','trace'],
                    'categories' => ['app'],
                    'exportInterval' => 1,
                    'logFile' => '@app/runtime/logs/info/app.log',
                    'logVars'=>[],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','trace','error','warning'],
                    'categories' => ['grant'],
                    'exportInterval' => 1,
                    'logFile' => '@app/runtime/logs/grant/app.log',
                    'logVars'=>[],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','trace','error','warning'],
                    'categories' => ['extract'],
                    'logFile' => '@app/runtime/logs/extract/app.log',
                    'logVars'=>[],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','trace','error','warning'],
                    'categories' => ['url'],
                    'exportInterval' => 1,
                    'logFile' => '@app/runtime/logs/url/app.log',
                    'logVars'=>[],
                ],
            ],
        ],
    ],
    'params' => $params,
];
