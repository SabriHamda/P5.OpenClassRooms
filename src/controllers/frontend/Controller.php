<?php
namespace src\controllers\frontend;

/**
 * Description of Controller
 *
 * @author Sabri Hamda
 */
class Controller extends \src\controllers\Controller
{
    public function getViewsBasePath()
    {
        return realpath('../views/frontend/');
    }
}
