<?php
namespace blog\src\tools;
use blog\src\model\ArticleManager;
use blog\src\model\CommentManager;


/**
 * TablePaginate.class.php
 *
 * This Class Paginate any table in the data base.
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
	public static function paginate(string $table, int $nbResult, string $orderBy)

    {
    	$ArticleManager = new ArticleManager();
        $countRows = $ArticleManager->countTableRows($table); //count number of rows in table
        //$nbResult = 3; // number of results to view
        $nbPage = ceil($countRows/$nbResult); //round up number of pages ex: 4,3 to 5
        $paginateTable = array();
			for($i=0; $i<= $nbPage; $i++){
				$paginateTable[] = $ArticleManager->getPaginateTable($table,($nbResult*$i), $nbResult,$orderBy);
	        }
        $results = ['nbPage'=> $nbPage, 'total'=> $countRows,'paginate'=> $paginateTable];
        return $results;
    }
}



