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

        /*************************************** ARTICLE ACTION ***********************************************/
        
        case 'post':
        $action->actionArticle();
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

        /*************************************** COMMENTS ACTION ********************************************/    

        case 'comments':
        $action->actionComments();
        break;

        /*************************************** VALIDATE-COMMENT ACTION *********************************/    

        case 'validate-comment':
        $action->actionValidateComment();
        break;
        /*************************************** ADD ARTICLE ACTION ***************************************/    

        case 'add-article':
        $action->actionAddArticle();
        break;

        /*************************************** UPDATE ARTICLE ACTION ************************************/

        case 'edit-article':
        $action->actionEditArticle();
        break;

        /*************************************** LOGOUT ACTION ***********************************************/

        case 'logout':
        $action->actionLogOut();
        break;

        /*************************************** TRANSLATE ACTION *******************************************/

        case 'translate':
            if(isset($_GET['data']) && !empty($_GET['lang'])){
                $action->actionTranslate();
            }else{
                echo 'Aucune langue selectionée';
            }
        break;

        /*************************************** ERRORS ACTION ********************************************/

        default :
        $action->actionHome();
        break;

    }

}
catch (Exception $e) {
    $action->actionError($e);
}

