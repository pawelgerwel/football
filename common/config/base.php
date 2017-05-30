<?php
$config = [
    'name'=>'Football',
    'vendorPath'=>dirname(dirname(__DIR__)).'/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'sourceLanguage'=>'en-US',
    'language'=>'en-US',
    'bootstrap' => ['log'],
    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache'
        ],

        'formatter'=>[
            'class'=>'yii\i18n\Formatter'
        ],

        'db'=>[
            'class'=>'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'tablePrefix' => env('DB_TABLE_PREFIX'),
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix'=>function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

        'keyStorage' => [
            'class' => 'common\components\keyStorage\KeyStorage'
        ],

        'urlManagerBackend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => env('BACKEND_HOST_INFO'),
                'baseUrl' => env('BACKEND_BASE_URL'),
            ],
            require(Yii::getAlias('@backend/config/_urlManager.php'))
        ),
        'urlManagerFrontend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => env('FRONTEND_HOST_INFO'),
                'baseUrl' => env('FRONTEND_BASE_URL'),
            ],
            require(Yii::getAlias('@frontend/config/_urlManager.php'))
        ),
    ],
    'params' => [
        'adminEmail' => env('ADMIN_EMAIL'),
        'robotEmail' => env('ROBOT_EMAIL'),
        'availableLocales'=>[
            'en-US'=>'English (US)',
            'ru-RU'=>'Русский (РФ)',
            'uk-UA'=>'Українська (Україна)',
            'es' => 'Español',
            'vi' => 'Tiếng Việt',
            'zh-CN' => '简体中文',
            'pl-PL' => 'Polski (PL)',
        ],
    ],
];

if (YII_ENV_PROD) {
    $config['components']['log']['targets']['email'] = [
        'class' => 'yii\log\EmailTarget',
        'except' => ['yii\web\HttpException:*'],
        'levels' => ['error', 'warning'],
        'message' => ['from' => env('ROBOT_EMAIL'), 'to' => env('ADMIN_EMAIL')]
    ];
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module'
    ];

    $config['components']['cache'] = [
        'class' => 'yii\caching\DummyCache'
    ];
}

return $config;
