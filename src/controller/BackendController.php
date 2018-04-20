<?php
namespace blog\src\controller;
use blog\src\model\PostManager;
use blog\src\model\CommentManager;
/**
* 
*/
class BackendController
{
    protected $checkAdminSession;


    /**
     * [addArticle description]
     * @param [type] $articleTitle    [description]
     * @param [type] $articleImageUrl [description]
     * @param [type] $articleContent  [description]
     */
    public static function addArticle($articleTitle,$articleImageUrl,$articleContent,$articleContentRight)
    {
        $addNewArticle = new PostManager();
        $addNewArticle->addArticle($articleTitle,$articleImageUrl,$articleContent,$articleContentRight);

    }

    public static function updateArticle($articleId,$articleTitle,$articleImageUrl,$articleContent,$articleContentRight)
    {
        $updateArticle = new PostManager();
        $updateArticle->updateArticle($articleId,$articleTitle,$articleImageUrl,$articleContent,$articleContentRight);

    }

    /**
     * [checkAdminSession description]
     * @return [type] [description]
     */
    public function checkAdminSession(){
        if (!empty($_SESSION['prenom']) && !empty($_SESSION['password']) && !empty($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                $this->$checkAdminSession = TRUE;
            }else{
            $this->$checkAdminSession = FALSE;
        }   
        }else{
            $this->$checkAdminSession = FALSE;
        } 
               
    }
}