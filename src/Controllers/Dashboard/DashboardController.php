<?php

namespace src\Controllers\Dashboard;

use src\Tools\Pagination;

/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class DashboardController extends ProtectedController
{
    private $articlePaginate;
    private $articleCountPages;
    private $articlePage;
    public $message = [];

    /**
     *
     */
    public function index()
    {
        $uri = blog()->getRequest()->getUri();
        $user = blog()->getIdentity()->getUser();
        $this->paginateArticles(1);

        echo $this->render('dashboard.twig', [
            'user' => $user,
            'uri' => $uri,
            'articles' => $this->articlePaginate,
            'page' => $this->articlePage,
            'countPages' => $this->articleCountPages,
            'message' => $this->getMessage()
        ]);
    }

    /**
     * @param $page
     */
    private function paginateArticles($page)
    {
        if (empty($page)) {
            $this->articlePage = 1;
        }

        $pagination = new Pagination();
        $paginate = $pagination->run('posts', 4, $page);
        $countPages = $pagination->getCountPages();
        $this->articlePaginate = $paginate;
        $this->articleCountPages = $countPages;
        $this->articlePage = $page;
    }
}
