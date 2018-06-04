<?php

namespace src\controllers\dashboard;

/**
 * Description of Controller.
 *
 * @author Sabri Hamda
 */
class Controller extends \src\controllers\Controller
{
    public function getViewsBasePath()
    {
        return realpath('../views/dashboard/');
    }
}
