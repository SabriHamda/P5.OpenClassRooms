<?php

namespace blog\controllers\dashboard;

/**
 * Description of Controller
 *
 * @author Sabri Hamda
 */
class Controller extends \blog\controllers\Controller{
    public function getViewsBasePath(){
     return realpath('../views/dashboard/');
    }
}
