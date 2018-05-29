<?php

return [
  /* Frontend */
  'home' => [
    'path' => '/home',
    'controller' => src\controllers\frontend\HomeController::class,
    'action' => 'index',
  ],
  'about' => [
    'path' => '/about',
    'controller' => src\controllers\frontend\AboutController::class,
    'action' => 'index',
  ],
   /* Backend */
  'adminLogin' => [
    'path' => '/dashboard/login',
    'controller' => src\controllers\dashboard\AuthController::class,
    'action' => 'index',
  ],
  'adminLoginDo' => [
    'path' => '/dashboard/login',
    'controller' => src\controllers\dashboard\AuthController::class,
    'action' => 'login',
    'method'=> 'POST'
  ],
  'homepage' => [
    'path' => '/dashboard',
    'controller' => src\controllers\dashboard\DashboardController::class,
    'action' => 'index',
  ],
  'articles' => [
    'path' => '/dashboard/articles',
    'controller' => src\controllers\dashboard\ArticleController::class,
    'action' => 'index',
  ],

  'article_details' => [
    'path' => '/dashboard/articles/view/{id}',
    'controller' => src\controllers\dashboard\ArticleController::class,
    'action' => 'view',
    'params' => [
      'id' => '[0-9]+',
    ],
  ],
  'article_add' => [
    'path' => '/dashboard/articles/create',
    'controller' => src\controllers\dashboard\ArticleController::class,
     'action' => 'create',
  ],
  'article_update' => [
    'path' => '/dashboard/articles/update',
    'controller' => src\controllers\dashboard\ArticleController::class,
     'action' => 'update',
  ],
  'article_delete' => [
    'path' => '/dashboard/articles/delete/{id}',
    'method' => 'POST',
    'controller' => src\controllers\dashboard\ArticleController::class,
    'action' => 'delete',
    'params' => [
      'id' => '[0-9]+',
    ],
  ],
];
