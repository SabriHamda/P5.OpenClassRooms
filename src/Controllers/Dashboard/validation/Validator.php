<?php
/**
 * Created by Sabri Hamda.
 * Date: 21.06.18
 * Time: 14:47
 */

namespace src\Controllers\Dashboard\Validation;


class Validator
{
    public static function articleValidate($id)
    {
        if (!empty($id) && !empty($_POST['title-article-update']) && !empty($_POST['content-article-update']) && !empty($_POST['content-right-article-update'])) {

            return true;
        }
        return false;
    }
}