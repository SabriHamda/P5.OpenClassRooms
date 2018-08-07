<?php

namespace src\Controllers\Frontend;

use src\Controllers\AbstractController;

/**
 * This Controller Control Frontend actions
 *
 * @author Sabri Hamda
 */
class FrontendController extends AbstractController
{
    public function getViewsBasePath()
    {
        return realpath('../views/Frontend/');
    }
}
