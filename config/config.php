<?php
return [
    'router' => [
        'controller' => 'site',
        'action' => 'test'
    ],
    '404' => '/site/404',
    'components' => [
        'cache' => 'farkens\components\Cache',
        'session' => 'farkens\components\Session',
    ]
];