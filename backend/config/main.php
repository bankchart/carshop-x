<?php

use yii\web\Request;

$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => '<b>CAR</b>SHOP',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
            'downloadAction' => 'gridview/export/download',
        ]
    ],
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@backend/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.xxx',
                'username' => 'xxx@xxx',
                'password' => 'xxxxxx',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@backend/views' => '@backend/themes/adminlte'
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '' => 'site/index',
                'page/view/<id:\w+>' => 'page/view',
                //'<controller:\w+>' => '<controller>/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+(-\w+)*>/<action:\w+(-\w+)*>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+(-\w+)*>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+(-\w+)*>/<id:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+(-\w+)*>/<name:\w+(-\w+)*>' => '<controller>/<action>',

                /* controller to index */
                'page' => 'page/index',
                'car' => 'car/index',
                'site' => 'site/index',
                /* end controller to index */

                /* page */
                'about-contact' => 'page/view',
                'legal-notice' => 'page/view',
                'terms-and-conditions' => 'page/view',
                'faq' => 'faq/index',
                'home-slide' => 'site/home-slide',
                'caption' => 'site/caption',
                /* end page */

                /* car */
                'make-and-model' => 'make/index',
                'manage-model' => 'model/index',
                'category' => 'category/index',
                'sub-category' => 'sub-category/index',
                'get-sub-cat-by-cat' => 'car/get-sub-cat-by-cat',
                'update-display-category' => 'car/update-display-category',
                'remove-category' => 'car/remove-category',
                'social' => 'social/index',
                'mail-setting' => 'site/mail-setting',
                'recover-password' => 'site/recover-password',
                'delete-sub-category/<subcatId:\d+>/<catId:\d+>' => 'category/delete-sub-category',
                'delete-model/<modelId:\d+>/<makeId:\d+>' => 'make/delete-model',
                /* end car */

                'change-password' => 'site/change-password',
            ],
        ],

    ],
    'params' => $params,
];
