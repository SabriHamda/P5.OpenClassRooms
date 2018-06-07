<?php
require __DIR__ . './../vendor/autoload.php';

use src\exceptions\NotFoundHttpException;
use src\Blog;

function dd($val, $exit = true)
{
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
    if ($exit)
        exit;
}

function blog()
{
    return $GLOBALS['blog'];
}
try {
    $blog = new Blog();
    $blog->run();
    $GLOBALS['blog'] = $blog;
} catch (NotFoundHttpException $e) {
    header('location: error');
} catch (Exception $e) {
    header('location: home');
}
