<?php
namespace blog\src\controller;
use blog\src\model\PostManager;
use blog\src\model\CommentManager;
/**
* 
*/
class BackendController
{
	
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
}