<?php

return [
    /* Frontend */
    '' => [
        'path' => '',
        'controller' => src\Controllers\Frontend\HomeController::class,
        'action' => 'index',
    ],
    'home' => [
        'path' => '/home',
        'controller' => src\Controllers\Frontend\HomeController::class,
        'action' => 'index',
    ],
    'about' => [
        'path' => '/about',
        'controller' => src\Controllers\Frontend\AboutController::class,
        'action' => 'index',
    ],
    'blog' => [
        'path' => '/blog',
        'controller' => src\Controllers\Frontend\BlogController::class,
        'action' => 'index',
        'method' => 'GET',
        'params' => [
            'page' => '[0-9]+',
        ]
    ],
    'blog/page/{page}' => [
        'path' => '/blog/page/{page}',
        'controller' => src\Controllers\Frontend\BlogController::class,
        'action' => 'index',
        'method' => 'GET',
        'params' => [
            'page' => '[0-9]+',
        ]
    ],
    'article' => [
        'path' => '/article/{articleId}',
        'controller' => src\Controllers\Frontend\PostController::class,
        'action' => 'index',
        'params' => [
            'articleId' => '[0-9]+',
        ]
    ],
    'contact' => [
        'path' => '/contact',
        'controller' => src\Controllers\Frontend\ContactController::class,
        'action' => 'index',
    ],
    'login' => [
        'path' => '/login',
        'controller' => src\Controllers\Frontend\LoginController::class,
        'action' => 'index',
    ],
    'register' => [
        'path' => '/register',
        'controller' => src\Controllers\Frontend\RegisterController::class,
        'action' => 'index',
    ],
    'error' => [
        'path' => '/error',
        'controller' => src\Controllers\Frontend\ErrorController::class,
        'action' => 'index',
    ],
    /* Backend */
    'adminLogin' => [
        'path' => '/dashboard/login',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'index',
    ],
    'adminLoginDo' => [
        'path' => '/dashboard/login',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'login',
        'method' => 'POST'
    ],
    'adminLogout' => [
        'path' => '/logout',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'logout',
    ],
    'adminRequestResetPassword' => [
        'path' => '/dashboard/auth/password-reset',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'requestReset',
    ],
    'adminSentRecoveryToken' => [
        'path' => '/dashboard/auth/password-reset',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'sendRecoveryToken',
        'method' => 'POST'
    ],
    'adminValidateResetToken' => [
        'path' => '/dashboard/auth/password-reset',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'validateResetToken',
    ],
    'adminValidateResetToken' => [
        'path' => '/dashboard/auth/password-reset',
        'controller' => src\Controllers\Dashboard\AuthController::class,
        'action' => 'resetPassword',
    ],

    'homepage' => [
        'path' => '/dashboard',
        'controller' => src\Controllers\Dashboard\DashboardController::class,
        'action' => 'index',
    ],
    'articles' => [
        'path' => '/dashboard/articles',
        'controller' => src\Controllers\Dashboard\ArticleController::class,
        'action' => 'index',
    ],
    'articles/page/{page}' => [
        'path' => '/dashboard/articles/page/{page}',
        'controller' => src\Controllers\Dashboard\ArticleController::class,
        'action' => 'index',
        'params' => [
            'page' => '[0-9]+',
        ],
    ],

    'article_details' => [
        'path' => '/dashboard/articles/view/{id}',
        'controller' => src\Controllers\Dashboard\ArticleController::class,
        'action' => 'view',
        'params' => [
            'id' => '[0-9]+',
        ],
    ],
    'article_add' => [
        'path' => '/dashboard/articles/create',
        'controller' => src\Controllers\Dashboard\ArticleController::class,
        'action' => 'create',
    ],
    'article_update' => [
        'path' => '/dashboard/articles/update',
        'controller' => src\Controllers\Dashboard\ArticleController::class,
        'action' => 'update',
    ],
    'article_delete' => [
        'path' => '/dashboard/articles/delete/{id}',
        'method' => 'POST',
        'controller' => src\Controllers\Dashboard\ArticleController::class,
        'action' => 'delete',
        'params' => [
            'id' => '[0-9]+',
        ],
    ],
];
