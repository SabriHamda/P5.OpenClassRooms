<?php
require __DIR__ . './../vendor/autoload.php';


use app\Exceptions\NotFoundHttpException;
use app\Blog;


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
    throw $e;
} catch (Exception $e) {
    // WPCS: XSS OK
    echo $e->getmessage();
}
