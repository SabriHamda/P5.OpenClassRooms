<?php
namespace blog\controllers\dashboard;
/**
 * Description of HomeController
 *
 * @author Sabri Hamda
 */
class DashboardController extends Controller{
    
    public function index(){
       echo $this->render('dashboard.twig');
    }
}
