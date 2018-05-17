<?php

return [
  /* Frontend */
  'home' => [
    'path' => '/home',
    'controller' => blog\controllers\frontend\HomeController::class,
    'action'=> 'index'
  ],
  'about' => [
    'path' => '/about',
    'controller' => blog\controllers\frontend\AboutController::class,
    'action'=> 'index'
  ],
   /* Backend */
  'homepage' => [
    'path' => '/dashboard',
    'controller' => blog\controllers\dashboard\DashboardController::class,
    'action'=> 'index'
  ],
  'articles' => [
    'path' => '/dashboard/articles',
    'controller' => blog\controllers\dashboard\ArticleController::class,
    'action'=> 'index'
  ],
    
  'article_details' => [
    'path' => '/dashboard/articles/view/{id}',
    'controller' => blog\controllers\dashboard\ArticleController::class,
    'action'=> 'view',
    'params' => [
      'id' => '[0-9]+'
    ]
  ], 
  'article_add' => [
    'path' => '/dashboard/articles/create',
    'controller' => blog\controllers\dashboard\ArticleController::class,
     'action'=> 'create'
  ],
  'article_update' => [
    'path' => '/dashboard/articles/update',
    'controller' => blog\controllers\dashboard\ArticleController::class,
     'action'=> 'update'
  ],
  'article_delete' => [
    'path' => '/dashboard/articles/delete/{id}',
    'method' => 'POST',
    'controller' => blog\controllers\dashboard\ArticleController::class,
    'action'=> 'delete',
    'params' => [
      'id' => '[0-9]+'
    ]
  ]
];