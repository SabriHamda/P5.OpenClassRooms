<?php
namespace blog\src\controller;
use blog\src\model\PostManager;
use blog\src\model\CommentManager;

/**
* 
*/
class FrontendController
{


public function listPosts()

{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    return $posts;


    //require('view/frontend/listPostsView.twig');

}


public function post()

{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);

    $comments = $commentManager->getComments($_GET['id']);
    return ['post'=> $post, 'comments'=> $comments];
    
    


    //require ('view/frontend/postView.twig');

}

public function addComment($postId, $author, $comment, $civility)

{
	$commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment, $civility);


    if ($affectedLines === false) {

        throw new Exception("Impossible d\'ajouter le commentaire !");
          

    }

    else {

        header('Location: index.php?action=post&id=' . $postId . '#comments');

    }

    

}
public function errors($error){
	
	require 'view/frontend/errorView.twig';
} 

}

