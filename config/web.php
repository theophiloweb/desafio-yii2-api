<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gyp2FiZ43WP7xB5vtBPqVxlXEsZrrJTA',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
                $response->headers->set('Access-Control-Allow-Headers', 'Authorization, Content-Type');
            },
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',                   
                    'levels' => ['error', 'warning', 'info'],  // Incluindo 'info' para capturar detalhes
                    'logFile' => '@runtime/logs/app.log', 
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Rotas para a API de autenticação
                'POST login' => 'auth/login',

                // Rotas para o cliente
                ['class' => 'yii\rest\UrlRule', 
                 'controller' => 'cliente', 
                 'pluralize' => false, 
                 'extraPatterns' => [
                     'POST create' => 'create',
                     'GET index' => 'index',
                     'GET view' => 'view',
                     'PUT update' => 'update',
                     'DELETE delete' => 'delete',
                 ]
                ],

                // Rotas para o livro
                ['class' => 'yii\rest\UrlRule', 
                 'controller' => 'book', 
                 'pluralize' => false, 
                 'extraPatterns' => [
                     'POST create' => 'create',
                     'GET index' => 'index',
                     'GET view' => 'view',
                     'PUT update' => 'update',
                     'DELETE delete' => 'delete',
                 ]
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
