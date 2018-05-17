<?php
namespace blog\controllers\frontend;
/**
 * Description of HomeController
 *
 * @author Sabri Hamda
 */
class HomeController extends Controller{
    
    public function index(){
       echo $this->render('home.twig');
    }
}
