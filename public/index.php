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


$blog = new Blog();
$blog->run();
$GLOBALS['blog'] = $blog;

