<?php

require_once('vendor/autoload.php');
require_once('controller/frontend.php');

$loader = new Twig_Loader_Filesystem('view/frontend');

$twig = new Twig_Environment($loader, array(
    //'cache' => false,
));


try {


    $page = $_GET['action']; 


    switch($page) {

        case 'post':
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            echo $twig->render(
                'postView.twig',
                ['post'=> post()['post'],
                'comments'=> post()['comments']]
          );
        }
        else {
            throw new Exception("aucun identifiant d'article envoyé");
        }
        break;

        case 'accueil':
        echo $twig->render('accueil.twig', ['posts'=> listPosts()]);
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

        echo $twig->render('registerView.twig');

        break;
       
        
        

        
        
        case 'addComment':

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            if (!empty($_POST['author']) && !empty($_POST['comment']) && !empty($_POST['civility'])) {

                addComment($_GET['id'], $_POST['author'], $_POST['comment'], $_POST['civility']);

            }

            else {

                throw new Exception("Tous les champs ne sont pas remplis !");

            }

        }

        else {

            throw new Exception("aucun identifiant de billet envoyé");


        }

        

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

