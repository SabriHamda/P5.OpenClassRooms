<?php
session_start();
use blog\src\controller\Controller;
use blog\src\controller\UserController;
use blog\src\controller\FrontendController;
use blog\src\controller\BackendController;

require_once('vendor/autoload.php');




try {
    
    $page = isset($_GET['action']) ?  $_GET['action'] : 'accueil';
    $viewPage = new controller();


    switch($page) {

        case 'post':
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = new FrontendController();
            echo $viewPage->viewFrontEnd(
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
        
        echo $viewPage->viewFrontEnd('accueil.twig', ['posts'=> $listpost->listPosts()]);
        break;

        case 'about': 

        echo $viewPage->viewFrontEnd('about.twig');

        break;

        case 'blog': 

        echo $viewPage->viewFrontEnd('blog.twig');

        break;

        case 'portfolio':

        echo $viewPage->viewFrontEnd('portfolio.twig');

        break;
        case 'contact':

        echo $viewPage->viewFrontEnd('contact.twig');

        break;
        case 'register':


        if (!isset($_POST['registerSubmit'])) {
            
            echo $viewPage->viewFrontEnd('registerView.twig',['etat'=> $etat]);
        }
        else{
            $role = "visitor";
            if (!empty($_POST['civility']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {

                if ($_POST['passwordConfirm'] == $_POST['password']) {
                  $addUser = new UserController;
                  $addUser->addUser($role, $_POST['prenom'],$_POST['password'],$_POST['email'],$_POST['civility']);
                  echo $viewPage->viewFrontEnd('registerView.twig',['prenom'=> $prenom]);
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
        if (empty($_SESSION['role'])) {
            echo $viewPage->viewFrontEnd('loginView.twig');
        }else{
            header('Location: index.php?action=accueil');
        }
        
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


    case 'dashboard':
    if (!empty($_SESSION['prenom']) && !empty($_SESSION['password']) && !empty($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $listpost = new FrontendController();
            $pageName = $_GET['action'];
            
            //$nbpage = $paginatePosts->$nbpage;
            if (empty($_GET['page'])) {
                $page=0;
            }else{
            $page = $_GET['page']-1;   
            }

            echo $viewPage->viewBackEnd('dashboardView.twig',
                [
                    'posts'=> BackendController::tablePaginate('posts', 5, 'created_at DESC'),
                    'comments'=> BackendController::tablePaginate('comments', 3, 'comment_date DESC'),
                    'page'=> $page,
                    'pageName'=> $pageName,
                    'nbPage'=>BackendController::tablePaginate('posts', 10, 'created_at DESC')
            ]);


        }else{
            header('Location: index.php?action=login');        }
    }else{
        header('Location: index.php?action=login');
    }
    break;

    case 'articles':
    if (!empty($_SESSION['prenom']) && !empty($_SESSION['password']) && !empty($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $listpost = new FrontendController();
            $pageName = $_GET['action'];
            
            //$nbpage = $paginatePosts->$nbpage;
            if (empty($_GET['page'])) {
                $page=0;
            }else{
            $page = $_GET['page']-1;   
            }



            
            echo $viewPage->viewBackEnd('listArticlesView.twig',
                [
                    'posts'=> BackendController::tablePaginate('posts', 10, 'created_at DESC'),
                    'comments'=> BackendController::tablePaginate('comments', 3, 'comment_date DESC'),
                    'page'=> $page,
                    'pageName'=> $pageName,
                    'nbPage'=>BackendController::tablePaginate('posts', 10, 'created_at DESC')
            ]);
        }else{
            header('Location: index.php?action=login');        }
    }else{
        header('Location: index.php?action=login');
    }
    break;

    case 'add-article':
    if (!empty($_SESSION['prenom']) && !empty($_SESSION['password']) && !empty($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $listpost = new FrontendController();
            $pageName = $_GET['action'];
            
            //$nbpage = $paginatePosts->$nbpage;
            if (empty($_GET['page'])) {
                $page=0;
            }else{
            $page = $_GET['page']-1;   
            }



            
            echo $viewPage->viewBackEnd('addArticleView.twig',
                [
                    'posts'=> BackendController::tablePaginate('posts', 10, 'created_at DESC'),
                    'comments'=> BackendController::tablePaginate('comments', 3, 'comment_date DESC'),
                    'page'=> $page,
                    'pageName'=> $pageName,
                    'nbPage' => BackendController::tablePaginate('posts', 10, 'created_at DESC')
            ]);


            // if submit the add article form
            if (!isset($_POST['submit-article-add'])) {
                # code...
            }else{
                if (!empty($_POST['title-article-add']) && !empty($_FILES['img-article-add']) && !empty($_POST['content-article-add'])) {
                    $articleTitle = $_POST['title-article-add'];
                    $articleImage = $_FILES['img-article-add'];
                    $articleContent = $_POST['content-article-add'];
                    $uploadMyFile = BackendController::uploadFile('img-article-add','public/assets/images/uploads/'.$articleImage["name"].'',FALSE,array('png','gif','jpg','jpeg'));

                    if ($uploadMyFile) {
                        echo '<script type="text/javascript"> alert("image bien enregistrer");</script>';
                        BackendController::addArticle($articleTitle,'public/assets/images/uploads/'.$articleImage["name"].'',$articleContent);
                    }else{
                        echo '<script type="text/javascript"> alert("probleme avec l\'image");</script>';
                    }

                    
                }else{
                   echo '<script type="text/javascript"> alert("champs vide");</script>';
                }

                echo '<script type="text/javascript"> alert("toucher");</script>';
            }

        }else{
            header('Location: index.php?action=login');        }
    }else{
        header('Location: index.php?action=login');
    }
    break;

    case 'logout':
    $logout = new UserController();
    $logout->logout();
        //echo $viewPage->viewFrontEnd('accueil.twig');

    break;

    default :

    echo $viewPage->viewFrontEnd('accueil.twig');

    break;

}
}
catch (Exception $e) {

    $error = $e->getMessage();
    echo $viewPage->viewFrontEnd('errorView.twig', ['error'=> $error]);
    
}

