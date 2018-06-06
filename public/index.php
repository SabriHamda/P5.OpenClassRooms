<?php 
require __DIR__ . './../vendor/autoload.php';

use src\Blog;


function dd($val, $exit = true){
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
    if($exit)
    exit;
}

function blog(){
    return $GLOBALS['blog'];
}

try {

    $blog = new Blog();
    $blog->run();
    $GLOBALS['blog'] = $blog;

}catch (Exception $e){
    $message = $e->getMessage();
    if ($message === '404')
    {
        header('location: error');
    }else{
        header('location: home');
    }
}
