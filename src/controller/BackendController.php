<?php
namespace blog\src\controller;
use blog\src\model\PostManager;
use blog\src\model\CommentManager;
/**
* 
*/
class BackendController
{
	 public function listPostPaginate($nbResult)

    {
    	$postManager = new PostManager();
        $countPosts = $postManager->countPosts(); // total number of rows in table
        //$nbResult = 3; // number of results to view
        $nbPage = round(($countPosts/$nbResult), 0, \PHP_ROUND_HALF_UP); //round up number of pages ex: 4,3 to 5
        $paginatePosts = array();
			for($i=0; $i<=$nbPage; $i++){
				$paginatePosts[] = $postManager->getPaginatePosts(($nbResult*$i), $nbResult);
	        }


        //$paginatePosts = $postManager->getPaginatePosts($nbResult);
        $results = ['nbPage'=> $nbPage, 'total'=> $countPosts,'paginate'=> $paginatePosts];
        return $results;
 
    }
}