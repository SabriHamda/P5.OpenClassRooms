<?php
namespace blog\src\tools;
use blog\src\model\PostManager;
use blog\src\model\CommentManager;


/**
 * GoogleTranslate.class.php
 *
 * This Class talk with Google Translator for free.
 */

/**
 * Main class TablePaginate
 *
 */


class TablePaginate {

	/**
     * paginate is function to paginate any table in the data base 
     * @param  [string] $table    [the name of the table to paginate]
     * @param  [int] $nbResult [number of rows/page to return]
     * @param  [string] $orderBy  [the order of rows ex: ID DESC ]
     * @return [array] $result        [array with number of pages,total of rows and all pages]
     */
	public static function paginate($table, $nbResult,$orderBy)

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



