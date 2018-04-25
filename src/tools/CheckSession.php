<?php
namespace blog\src\tools;
use blog\src\model\ArticleManager;
use blog\src\model\CommentManager;
/**
* 
*/
class CheckSession
{
    //protected $checkAdminSession;

    /**
     * [checkAdminSession description]
     * @return [type] [description]
     */
    public static function checkAdminSession(){
        if (!empty($_SESSION['prenom']) && !empty($_SESSION['password']) && !empty($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                return $checkAdminSession = TRUE;
            }else{
            return $checkAdminSession = FALSE;
        }   
        }else{
            return $checkAdminSession = FALSE;
        } 
               
    }

    
}