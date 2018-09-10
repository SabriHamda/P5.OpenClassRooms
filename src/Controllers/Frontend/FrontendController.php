<?php

namespace app\Controllers\Frontend;

use app\Controllers\AbstractController;

/**
 * This Controller Control Frontend actions
 *
 * @author Sabri Hamda
 */
class FrontendController extends AbstractController
{
    public function getViewsBasePath()
    {
        return realpath('../views/frontend/');
    }
}
