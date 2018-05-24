<?php

namespace src\models;

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
}
