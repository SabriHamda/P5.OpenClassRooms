<?php
require_once(__DIR__ .'/vendor/autoload.php');
use blog\src\controller\FrontendController;



$loader = new Twig_Loader_Filesystem(__DIR__ . '/src/view/frontend');

$twig = new Twig_Environment($loader, array(
    //'cache' => false,
));


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

        echo $twig->render('registerView.twig');

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

        default :

        echo $twig->render('accueil.twig');

        break;

    }

}
catch (Exception $e) {

    $error = $e->getMessage();
    echo $twig->render('errorView.twig', ['error'=> $error]);
    
}

