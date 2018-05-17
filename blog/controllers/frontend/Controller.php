<?php

namespace blog\controllers\frontend;

/**
 * Description of Controller
 *
 * @author Sabri Hamda
 */
class Controller extends \blog\controllers\Controller{
    public function getViewsBasePath(){
     return realpath('../views/frontend/');
    }
}
