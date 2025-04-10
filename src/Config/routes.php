<?php 
return [
    'home' => [        
        'path' => '/',
        'methods' => [
                        'GET' => [
                            'controller' => [MainApp\Controllers\IndexController::class, 'index'],
                        ],
                        'POST' => [
                            'controller' => [MainApp\Controllers\IndexController::class, 'postData'],
                        ],
                    ],
                ],
    'about' => [
        'path' => '/about',
        'methods' => [
                        'GET' => [
                            'controller' => [MainApp\Controllers\AboutController::class, 'show'],
                            'needauth' => false,
                            'onlyforguest' => true,
                        ],
                    ],
                ],
   
];