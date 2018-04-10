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
     * tablePaginate is function to paginate any table in the data base 
     * @param  [string] $table    [the name of the table to paginate]
     * @param  [int] $nbResult [number of rows/page to return]
     * @param  [string] $orderBy  [the order of rows ex: ID DESC ]
     * @return [array] $result        [array with number of pages,total of rows and all pages]
     */
	 public static function tablePaginate($table, $nbResult,$orderBy)

    {
    	$postManager = new PostManager();
        $countRows = $postManager->countTableRows($table); //count number of rows in table
        //$nbResult = 3; // number of results to view
        $nbPage = ceil($countRows/$nbResult); //round up number of pages ex: 4,3 to 5
        $paginateTable = array();
			for($i=0; $i<= $nbPage; $i++){
				$paginateTable[] = $postManager->getPaginateTable($table,($nbResult*$i), $nbResult,$orderBy);
	        }
        $results = ['nbPage'=> $nbPage, 'total'=> $countRows,'paginate'=> $paginateTable];
        return $results;
    }

    /**
     * [uploadFile this function upload file in folder after verifications]
     * @param  [string]  $index    [the file to upload]
     * @param  [string]  $destination [path to the destination folder]
     * @param  boolean or int $maxsize     [the size of the file]
     * @param  boolean or array $extensions  [the accepted extensions of the file]
     * @return [type]               [description]
     */
    public static function uploadFile($index,$destination,$maxsize=FALSE,$extensions=FALSE)

    {
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE; //Test1: fille correctly uploaded
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE; //Test2: limit size of the file
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1); //Test3: accepted extensions
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination); //Move the file in the folder
    }
    /**
     * [addArticle description]
     * @param [type] $articleTitle    [description]
     * @param [type] $articleImageUrl [description]
     * @param [type] $articleContent  [description]
     */
    public static function addArticle($articleTitle,$articleImageUrl,$articleContent)
    {
        $addNewArticle = new PostManager();
        $addNewArticle->addArticle($articleTitle,$articleImageUrl,$articleContent);

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