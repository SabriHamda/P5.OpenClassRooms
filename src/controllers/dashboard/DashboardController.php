<?php

namespace src\controllers\dashboard;

/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class DashboardController extends ProtectedController
{
    public function index()
    {
        echo $this->render('dashboard.twig');
    }
}
