<?php
session_start();
use blog\src\controller\Controller;
use blog\src\controller\UserController;
use blog\src\controller\FrontendController;
require_once('vendor/autoload.php');



$controller = new Controller($loader,$twig);
$loader = $controller->$loader;
$twig = $controller->$twig;
$twig->addGlobal('session', $_SESSION);
$token= $_SESSION['token']= md5(uniqid(mt_rand(),true)); 







try {
    

    $page = $_GET['action']; 


    switch($page) {

        case 'post':
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = new FrontendController();
            echo $twig->render(
                'postView.twig',
                ['post'=> $post->post()['post'],
                'comments'=> $post->post()['comments']]
          );
        }
        else {
            throw new Exception("aucun identifiant d'article envoyé");
        }
        break;

        case 'accueil':
        $listpost = new FrontendController();
        
        echo $twig->render('accueil.twig', ['posts'=> $listpost->listPosts()]);
        break;

        case 'about': 

        echo $twig->render('about.twig');

        break;

        case 'blog': 

        echo $twig->render('blog.twig');

        break;

        case 'portfolio':

        echo $twig->render('portfolio.twig');

        break;
        case 'contact':

        echo $twig->render('contact.twig');

        break;
        case 'register':


        if (!isset($_POST['registerSubmit'])) {
            
            echo $twig->render('registerView.twig',['etat'=> $etat]);
        }
        else{
            $role = "visitor";
            if (!empty($_POST['civility']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {

                if ($_POST['passwordConfirm'] == $_POST['password']) {
                      $addUser = new UserController;
                      $addUser->addUser($role, $_POST['prenom'],$_POST['password'],$_POST['email'],$_POST['civility']);
                echo $twig->render('registerView.twig',['prenom'=> $prenom]);
            }
            else {

                throw new Exception("Impossible de vous enregistrer, Les deux mot des passe ne sont pas identique");

            }
                }else {

                throw new Exception("Impossible de vous enregistrer, Tous les champs ne sont pas remplis !");

            }

              
        }

        break;
        case 'login':
        if (!isset($_POST['loginSubmit'])) {
            echo $twig->render('loginView.twig');
        }else{
            if (!empty($_POST['email'] && !empty($_POST['password']))) {
                $login = new UserController();
                $login->login($_POST['email'],$_POST['password']);
            }else{
                throw new Exception("Impossible de vous enregistrer, Veuillez vérifier vos informations de connection");
            }
        }

        

        break;
       
        
        

        
        
        case 'addComment':

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            if (!empty($_POST['author']) && !empty($_POST['comment']) && !empty($_POST['civility'])) {

                $addComment = new FrontendController();

                $addComment->addComment($_GET['id'], $_POST['author'], $_POST['comment'], $_POST['civility']);

            }

            else {

                throw new Exception("Tous les champs ne sont pas remplis !");

            }

        }

        else {

            throw new Exception("aucun identifiant de billet envoyé");


        }

        

        break;

        case 'logout':
        $logout = new UserController();
        $logout->logout();
        //echo $twig->render('accueil.twig');

        break;

        default :

        echo $twig->render('accueil.twig');

        break;

    }

}
catch (Exception $e) {

    $error = $e->getMessage();
    echo $twig->render('errorView.twig', ['error'=> $error]);
    
}

