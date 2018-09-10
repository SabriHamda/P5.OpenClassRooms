<?php

return [
    /* Frontend */
    '' => [
        'path' => '',
        'controller' => app\Controllers\Frontend\HomeController::class,
        'action' => 'index',
    ],
    'home' => [
        'path' => '/home',
        'controller' => app\Controllers\Frontend\HomeController::class,
        'action' => 'index',
    ],
    'about' => [
        'path' => '/about',
        'controller' => app\Controllers\Frontend\AboutController::class,
        'action' => 'index',
    ],
    'blog' => [
        'path' => '/blog',
        'controller' => app\Controllers\Frontend\BlogController::class,
        'action' => 'index',
        'method' => 'GET',
        'params' => [
            'page' => '[0-9]+',
        ]
    ],
    'blog/page/{page}' => [
        'path' => '/blog/page/{page}',
        'controller' => app\Controllers\Frontend\BlogController::class,
        'action' => 'index',
        'method' => 'GET',
        'params' => [
            'page' => '[0-9]+',
        ]
    ],
    'article' => [
        'path' => '/article/{articleId}',
        'controller' => app\Controllers\Frontend\PostController::class,
        'action' => 'index',
        'params' => [
            'articleId' => '[0-9]+',
        ]
    ],
    'contact' => [
        'path' => '/contact',
        'controller' => app\Controllers\Frontend\ContactController::class,
        'action' => 'index',
    ],
    'contact_do' => [
        'path' => '/contact',
        'controller' => app\Controllers\Frontend\ContactController::class,
        'action' => 'validateContact',
        'method' => 'POST'
    ],
    'login' => [
        'path' => '/login',
        'controller' => app\Controllers\Frontend\LoginController::class,
        'action' => 'index',
    ],
    'register' => [
        'path' => '/register',
        'controller' => app\Controllers\Frontend\RegisterController::class,
        'action' => 'index',
    ],
    'register_do' => [
        'path' => '/register',
        'controller' => app\Controllers\Frontend\RegisterController::class,
        'action' => 'addUser',
        'method' => 'POST',
    ],
    'error' => [
        'path' => '/error',
        'controller' => app\Controllers\Frontend\ErrorController::class,
        'action' => 'index',
    ],
    /* Backend */
    'LoginDo' => [
        'path' => '/login',
        'controller' => app\Controllers\Authentication\AuthController::class,
        'action' => 'login',
        'method' => 'POST'
    ],
    'Logout' => [
        'path' => '/logout',
        'controller' => app\Controllers\Authentication\AuthController::class,
        'action' => 'logout',
    ],
    'RequestResetPassword' => [
        'path' => '/password-reset',
        'controller' => app\Controllers\Authentication\AuthController::class,
        'action' => 'requestReset',
    ],
    'SentRecoveryToken' => [
        'path' => '/password-reset',
        'controller' => app\Controllers\Authentication\AuthController::class,
        'action' => 'sendRecoveryToken',
        'method' => 'POST'
    ],
    'ValidateResetToken' => [
        'path' => '/password-reset',
        'controller' => app\Controllers\Authentication\AuthController::class,
        'action' => 'validateResetToken',
    ],
    'ValidateResetToken' => [
        'path' => '/password-reset/token/{token}',
        'controller' => app\Controllers\Frontend\ResetPasswordController::class,
        'action' => 'index',
        'params' => [
            'token' => '[0-9,a-z,A-Z]+'
        ]
    ],
    'UpdatePassword' => [
        'path' => '/password-reset/token/{token}',
        'controller' => app\Controllers\Frontend\ResetPasswordController::class,
        'action' => 'updatePassword',
        'method' => 'POST',
        'params' => [
            'token' => '[0-9,a-z,A-Z]+'
        ]
    ],

    'homepage' => [
        'path' => '/dashboard',
        'controller' => app\Controllers\Dashboard\DashboardController::class,
        'action' => 'index',
    ],
    'articles' => [
        'path' => '/dashboard/articles',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'index',
    ],
    'articles/page/{page}' => [
        'path' => '/dashboard/articles/page/{page}',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'index',
        'params' => [
            'page' => '[0-9]+',
        ],
    ],

    'article_edit' => [
        'path' => '/dashboard/article/edit/{id}',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'editArticle',
        'params' => [
            'id' => '[0-9]+',
        ],
    ],
    'article_update' => [
        'path' => '/dashboard/article/edit/{id}',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'updateArticle',
        'method' => 'POST',
        'params' => [
            'id' => ('[0-9]+'),
        ],
    ],
    'article_add' => [
        'path' => '/dashboard/article/add',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'createArticleIndex'
    ],
    'article_add_do' => [
        'path' => '/dashboard/article/add',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'addArticle',
        'method' => 'POST'
    ],
    'delete_article' => [
        'path' => '/dashboard/article/del/{id}',
        'controller' => app\Controllers\Dashboard\Articles\ArticleController::class,
        'action' => 'delArticle',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ],
    'validate_comment' => [
        'path' => '/dashboard/comment/val/{id}',
        'controller' => app\Controllers\Dashboard\Comments\CommentController::class,
        'action' => 'validateThisComment',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ],
    'delete_comment' => [
        'path' => '/dashboard/comment/del/{id}',
        'controller' => app\Controllers\Dashboard\Comments\CommentController::class,
        'action' => 'deleteComment',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ],
    'add_comment' => [
        'path' => '/comment/add/{id}',
        'controller' => app\Controllers\Frontend\CommentController::class,
        'action' => 'addComment',
        'method' => 'POST',
        'params' => [
            'id' => ('[0-9]+')
        ]
    ]
];
