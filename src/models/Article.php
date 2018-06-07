<?php

namespace src\models;

use src\exceptions\NotFoundHttpException;
/**
 * Description of Article.
 *
 * @author Sabri Hamda
 */
class Article
{
    public static function find($condition)
    {
        return new self();
    }
    
    
    public function findOrFail($id){
        $article = false;
        if(!$article){
            throw new NotFoundHttpException('This article doesnt exist!');
        }
    }
}
