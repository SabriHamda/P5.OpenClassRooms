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


$blog = new Blog();
$blog->run();

