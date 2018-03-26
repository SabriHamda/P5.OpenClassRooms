<?php
namespace blog\src\controller;
use blog\src\model\PostManager;
use blog\src\model\CommentManager;
/**
* 
*/
class FrontendController
{

/**
 * [listPosts description]
 * @return [type] [description]
 */
public function listPosts()

{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    return $posts;


    //require('view/frontend/listPostsView.twig');

}

/**
 * [post description]
 * @return [type] [description]
 */
public function post()

{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);

    $comments = $commentManager->getComments($_GET['id']);
    return ['post'=> $post, 'comments'=> $comments];
    
    


    //require ('view/frontend/postView.twig');

}
/**
 * [addComment description]
 * @param [type] $postId   [description]
 * @param [type] $author   [description]
 * @param [type] $comment  [description]
 * @param [type] $civility [description]
 */
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

/**
 * [errors description]
 * @param  [type] $error [description]
 * @return [type]        [description]
 */
public function errors($error){
	
	require 'view/frontend/errorView.twig';
} 

}

