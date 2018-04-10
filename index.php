<?php
session_start();
use blog\src\controller\Controller;

require_once('vendor/autoload.php');



/**
 *  This is the router of the application
 */

try {
    /* If there's no action, default action is Home page */
    $page = isset($_GET['action']) ?  $_GET['action'] : 'home';
    $action = new Controller();


    switch($page) {

        /*************************************** POST ACTION ***********************************************/
        
        case 'post':
        $action->actionPost();
        break;

        /*************************************** HOME ACTION ***********************************************/

        case 'home':
        $action->actionHome();
        break;

        /*************************************** ABOUT ACTION ***********************************************/

        case 'about':
        $action->actionAbout();
        break;

        /*************************************** BLOG ACTION ***********************************************/

        case 'blog':
        $action->actionBlog();
        break;

        /*************************************** PORTFOLIO ACTION ******************************************/

        case 'portfolio':
        $action->actionPortfolio();
        break;

        /*************************************** CONTACT ACTION *******************************************/

        case 'contact':
        $action->actionContact();
        break;

        /*************************************** REGISTER ACTION ********************************************/

        case 'register':
        $action->actionRegister();
        break;

        /*************************************** LOGIN ACTION ***********************************************/

        case 'login':
        $action->actionLogin();
        break;

        /*************************************** ADDCOMMENT ACTION ****************************************/    

        case 'addComment':
        $action->actionAddComment();
        break;

        /*************************************** DASHBOARD ACTION *******************************************/

        case 'dashboard':
        $action->actionDashboard();
        break;

        /*************************************** ARTICLES ACTION ********************************************/    

        case 'articles':
        $action->actionArticles();
        break;

        /*************************************** ADD ARTICLE ACTION ***************************************/    

        case 'add-article':
        $action->actionAddArticles();
        break;

        /*************************************** LOGOUT ACTION ***********************************************/

        case 'logout':
        $action->actionLogOut();
        break;

        /*************************************** DEFAULT ACTION ********************************************/

        default :
        $action->actionHome();
        break;

    }

}
catch (Exception $e) {
    $action->actionError();
}

