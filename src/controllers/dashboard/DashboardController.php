<?php

namespace src\Controllers\Dashboard;

/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class DashboardController extends ProtectedController
{
    public function index()
    {
        $user = blog()->getIdentity()->getUser();
        echo $this->render('dashboard.twig', ['user'=> $user]);
    }
}
