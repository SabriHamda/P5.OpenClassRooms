<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function page()
{
	$postManager = new PostManager();
	$posts = $postManager->getPosts();
	$title= 'mon blog';
	
}

function listPosts()

{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    return $posts;


    //require('view/frontend/listPostsView.twig');

}


function post()

{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);

    $comments = $commentManager->getComments($_GET['id']);
    return ['post'=> $post, 'comments'=> $comments];
    
    


    //require ('view/frontend/postView.twig');

}

function addComment($postId, $author, $comment, $civility)

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
function errors($error){
	
	require 'view/frontend/errorView.twig';
} 

