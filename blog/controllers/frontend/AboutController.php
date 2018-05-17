<?php
namespace blog\controllers\frontend;
/**
 * Description of HomeController
 *
 * @author Sabri Hamda
 */
class AboutController extends Controller{
    
    public function index(){
       echo $this->render('about.twig');
    }
}
