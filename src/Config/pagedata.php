<?php
return [
    'home'=>[
                'id'=>1,
                'baseTemplate' => null,
                'contentFile' => 'Index',        
                'pagetitle' => 'Главная страница',
                'description' => 'Описание главной страницы',
                'isHidden' => false,
                'parentId' => null,
                'layer'=>1,
            ],
    'about'=>[
                'id'=>2,
                'baseTemplate' => 'base',
                'contentFile' => 'About',       
                'pagetitle' => 'О нас',
                'description' => 'Описание страницы О нас',
                'isHidden' => false,
                'parentId' => null,
                'layer'=>1,
            ]
];
