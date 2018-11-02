<?php
return [
    'rootDir' => __DIR__ . "/../",
    'templatesDir' => __DIR__ . "/../views/",
    'publicDir' => __DIR__ . "/../public/",
    'defaultController' => 'product',
    'controllerNamespace' => "app\\controllers",
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'Shop_Nastasya',
            'charset' => 'utf8'     
        ],
        'request' => [
            'class' => \app\services\request\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'repository' => [
            'class' => \app\models\repositories\AppRepository::class
        ],
        'files' => [
            'class' => \app\services\Files::class
        ],
        'resize' => [
            'class' => \app\vendor\Resize::class
        ],
    ]
]
?>