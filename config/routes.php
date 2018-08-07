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
    'contact_do' => [
        'path' => '/contact',
        'controller' => src\Controllers\Frontend\ContactController::class,
        'action' => 'validateContact',
        'method' => 'POST'
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
    'register_do' => [
        'path' => '/register',
        'controller' => src\Controllers\Frontend\RegisterController::class,
        'action' => 'addUser',
        'method' => 'POST',
    ],
    'error' => [
        'path' => '/error',
        'controller' => src\Controllers\Frontend\ErrorController::class,
        'action' => 'index',
    ],
    /* Backend */
    'LoginDo' => [
        'path' => '/login',
        'controller' => src\Controllers\Authentication\AuthController::class,
        'action' => 'login',
        'method' => 'POST'
    ],
    'Logout' => [
        'path' => '/logout',
        'controller' => src\Controllers\Authentication\AuthController::class,
        'action' => 'logout',
    ],
    'RequestResetPassword' => [
        'path' => '/password-reset',
        'controller' => src\Controllers\Authentication\AuthController::class,
        'action' => 'requestReset',
    ],
    'SentRecoveryToken' => [
        'path' => '/password-reset',
        'controller' => src\Controllers\Authentication\AuthController::class,
        'action' => 'sendRecoveryToken',
        'method' => 'POST'
    ],
    'ValidateResetToken' => [
        'path' => '/password-reset',
        'controller' => src\Controllers\Authentication\AuthController::class,
        'action' => 'validateResetToken',
    ],
    'ValidateResetToken' => [
        'path' => '/password-reset/token/{token}',
        'controller' => src\Controllers\Frontend\ResetPasswordController::class,
        'action' => 'index',
        'params' => [
            'token' => '[0-9,a-z,A-Z]+'
        ]
    ],
    'UpdatePassword' => [
        'path' => '/password-reset/token/{token}',
        'controller' => src\Controllers\Frontend\ResetPasswordController::class,
        'action' => 'updatePassword',
        'method' => 'POST',
        'params' => [
            'token' => '[0-9,a-z,A-Z]+'
        ]
    ],

    'homepage' => [
        'path' => '/dashboard',
        'controller' => src\Controllers\Dashboard\DashboardController::class,
        'action' => 'index',
    ],
    'articles' => [
        'path' => '/dashboard/articles',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'index',
    ],
    'articles/page/{page}' => [
        'path' => '/dashboard/articles/page/{page}',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'index',
        'params' => [
            'page' => '[0-9]+',
        ],
    ],

    'article_edit' => [
        'path' => '/dashboard/article/edit/{id}',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'editArticle',
        'params' => [
            'id' => '[0-9]+',
        ],
    ],
    'article_update' => [
        'path' => '/dashboard/article/edit/{id}',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'updateArticle',
        'method' => 'POST',
        'params' => [
            'id' => ('[0-9]+'),
        ],
    ],
    'article_add' => [
        'path' => '/dashboard/article/add',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'createArticleIndex'
    ],
    'article_add_do' => [
        'path' => '/dashboard/article/add',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'addArticle',
        'method' => 'POST'
    ],
    'delete_article' => [
        'path' => '/dashboard/article/del/{id}',
        'controller' => src\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'delArticle',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ],
    'validate_comment' => [
        'path' => '/dashboard/comment/val/{id}',
        'controller' => src\Controllers\Dashboard\Comments\CommentController::class,
        'action' => 'validateThisComment',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ],
    'delete_comment' => [
        'path' => '/dashboard/comment/del/{id}',
        'controller' => src\Controllers\Dashboard\Comments\CommentController::class,
        'action' => 'deleteComment',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ],
    'add_comment' => [
        'path' => '/comment/add/{id}',
        'controller' => src\Controllers\Frontend\CommentController::class,
        'action' => 'addComment',
        'method' => 'POST',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ]
];
