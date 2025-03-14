<?php
return [
    'home'=>[
                'id'=>1,
                'baseTemplate' => null,
                'contentFile' => 'Index',        
                'title' => 'Главная страница',
                'description' => 'Описание главной страницы',
                'isHidden' => false,
                'parentId' => null,
                'layer'=>1,
            ],
    'about'=>[
                'id'=>2,
                'baseTemplate' => 'base',
                'contentFile' => 'About',       
                'title' => 'О нас',
                'description' => 'Описание страницы О нас',
                'isHidden' => false,
                'parentId' => null,
                'layer'=>1,
            ]
];