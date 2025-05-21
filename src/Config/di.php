<?php
// config/di.php
return [
    'bindings' => [
        // Базовые привязки
        Core\Request::class,
        Core\Router::class => function($container) {
            return new Core\Router(
                $container,
                $container->get(Core\Response::class)
            );
        }
    ],
    
    'singletons' => [
        Core\Session::class,
        Core\Response::class,
        Core\Database\DatabaseManager::class => function($container) {
            return new Core\Database\DatabaseManager(
                Config::get('database')
            );
        }
    ]
];