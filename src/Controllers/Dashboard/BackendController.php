<?php

namespace src\Controllers\Dashboard;
use src\Controllers\AbstractController;

/**
 * This Controller Control Backend actions
 *
 * @author Sabri Hamda
 */
class BackendController extends AbstractController
{
    public function getViewsBasePath()
    {
        return realpath('../views/dashboard/');
    }
}
