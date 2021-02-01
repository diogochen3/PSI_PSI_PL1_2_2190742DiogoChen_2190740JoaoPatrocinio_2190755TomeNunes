<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Api',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            //'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/profile',
                    'pluralize' => false,

                    'extraPatterns' => ['GET set/{limit}' => 'set',
                                        'GET total' => 'total',
                                        'POST cprofile' => 'cprofile',
                                        'PUT profilenew/{id}' => 'profilenew',
                                        'DELETE profiledel/{id}' => 'profiledel',
                    ],
                    'tokens' => ['{id}'    => '<id:\\d+>',
                        '{limit}' => '<limit:\\d+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/especialidade',
                    'pluralize' => false,

                    'extraPatterns' => ['GET set/{limit}' => 'set',
                        'GET total' => 'total',
                        'POST cespecialidade' => 'cespecialidade',
                        'PUT especialidadenew/{id}' => 'especialidadenew',
                        'DELETE especialidadedel/{id}' => 'especialidadedel',
                    ],
                    'tokens' => ['{id}'    => '<id:\\d+>',
                        '{limit}' => '<limit:\\d+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/diagnostico',
                    'pluralize' => false,

                    'extraPatterns' => ['GET set/{limit}' => 'set',
                        'GET total' => 'total',
                        'POST cdiagnostico' => 'cdiagnostico',
                        'PUT diagnosticonew/{id}' => 'diagnosticonew',
                        'DELETE diagnosticodel/{id}' => 'diagnosticodel',
                    ],
                    'tokens' => ['{id}'    => '<id:\\d+>',
                    '{limit}' => '<limit:\\d+>',
                ]
                ],
                [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/user',
                'pluralize' => false,
                    'extraPatterns' => ['POST login' => 'login',
                    ],
            ],
                [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/marcacao',
                'pluralize' => false,

                    'extraPatterns' => ['GET set/{limit}' => 'set',
                                        'GET total' => 'total',
                                        'POST marcar' => 'marcar',
                                        'PUT marcacaonew/{id}' => 'marcacaonew',
                                        'DELETE marcardel/{id}' => 'marcardel',
            ],
              'tokens' => ['{id}'    => '<id:\\d+>',
                           '{limit}' => '<limit:\\d+>',
                  ]
            ],
                [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/receitas',
                    'pluralize' => false,
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/consultas',
                'pluralize' => false,
            ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/medicoespecialidade',
                    'pluralize' => false,
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/receitasconsultas',
                    'pluralize' => false,
                ],
            ],
        ],

    ],
    'params' => $params,
];
