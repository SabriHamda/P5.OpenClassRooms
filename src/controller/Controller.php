<?php
namespace blog\src\controller;

use blog\src\controller\UserController;
use blog\src\controller\FrontendController;
use blog\src\controller\BackendController;
use blog\src\tools\GoogleTranslate;
use blog\src\tools\TablePaginate;

/**
* This Class is the main controller of the application.
*/
class Controller 
{

	protected $loader;
	protected $twig;
	protected $backLoader;
	protected $twigBack;
	protected $viewFrontPage;
	protected $viewBackPage;
	protected $token;


	/**
	 * Configure Twig to load templates.
	 * @param obj $loader looks up the templates in the /src/view/frontend/ folder.
	 * @param obj $twig   Twig uses a central object called the environment (of class Twig_Environment). Instances of this class are used to store the configuration and extensions, and are used to load templates from the file system or other locations.
	 */
	function __construct()

	{
		$this->token = $_SESSION['token']= md5(uniqid(mt_rand(),true));

	}

	/**
	 * This function will render twig frontend views
	 * @param  string $page   the page to view
	 * @param  array  $params the params added to this view.
	 * @return string         the final page to view with it's params.
	 */
	public function viewFrontEnd($page, array $params = array())

	{
		$this->loader = new \Twig_Loader_Filesystem('src/view/frontend');
		$this->twig = new \Twig_Environment($this->loader, array(
	    	//'cache' => false,
		));
		$this->twig->addGlobal('session', $_SESSION);
		$this->viewFrontPage = $this->twig->render($page,$params);
		return $this->viewFrontPage;
	}

	/**
	 * This function will render twig backend views
	 * @param  string $page   the page to view
	 * @param  array  $params the params added to this view.
	 * @return string         the final page to view with it's params.
	 */
	public function viewBackEnd($page, array $params = array())

	{
		$this->backLoader = new \Twig_Loader_Filesystem('src/view/dashboard');
		$this->twigBack = new \Twig_Environment($this->backLoader, array(
	    	//'cache' => false,
		));
		$this->twigBack->addGlobal('session', $_SESSION);
		$this->viewBackPage = $this->twigBack->render($page,$params);
		return $this->viewBackPage;
	}
	
	public function actionTranslate(){
		if(isset($_GET['data']) && !empty($_GET['lang'])){
	$translate = $_GET['data'];
	$lang = $_GET['lang'];
	$result = GoogleTranslate::translate('auto',$lang,$translate);
	echo $result;
}else{
	echo 'aucune langue selectionée';
}
	}

	public function actionHome(){
		//$listpost = new FrontendController();
		$pageName = $_GET['action'];
		$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
        echo $this->viewFrontEnd(
        	'homeView.twig', 
        	['posts'=> TablePaginate::paginate('posts', 8, 'created_at DESC'),
        	'nbPage'=>TablePaginate::paginate('posts', 8, 'created_at DESC'),
        	'page'=> $page,
			'pageName'=> $pageName]);
	}

	public function actionAbout(){
        echo $this->viewFrontEnd('about.twig');
	}

	public function actionBlog(){
        $pageName = $_GET['action'];
		$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
        echo $this->viewFrontEnd(
        	'blog.twig',
        	['posts'=> TablePaginate::paginate('posts', 12, 'created_at DESC'),
        	'nbPage'=>TablePaginate::paginate('posts', 12, 'created_at DESC'),
        	'page'=> $page,
			'pageName'=> $pageName]);
	}

	public function actionPortfolio(){
        echo $this->viewFrontEnd('portfolio.twig');
	}

	public function actionContact(){
        echo $this->viewFrontEnd('contact.twig');
	}

	public function actionPost(){
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = new FrontendController();
            echo $this->viewFrontEnd(
                'postView.twig',
                ['post'=> $post->post()['post'],
                'comments'=> $post->post()['comments']]
            );
        }
        else {
            throw new Exception("aucun identifiant d'article envoyé");
        }
	}

	public function actionRegister(){
		if (!isset($_POST['registerSubmit'])) {
			echo $this->viewFrontEnd('registerView.twig');
		}
		else{
			$role = "visitor";
			if (!empty($_POST['civility']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {
				if ($_POST['passwordConfirm'] == $_POST['password']) {
					$addUser = new UserController;
					$addUser->addUser($role, $_POST['prenom'],$_POST['password'],$_POST['email'],$_POST['civility']);
					echo $this->viewFrontEnd('registerView.twig',['prenom'=> $prenom]);
				}
				else {
					throw new Exception("Impossible de vous enregistrer, Les deux mot des passe ne sont pas identique");
				}
			}else {
				throw new Exception("Impossible de vous enregistrer, Tous les champs ne sont pas remplis !");
			}
		}
	}

	public function actionLogin(){
		if (!isset($_POST['loginSubmit'])) {
			if (empty($_SESSION['role'])) {
				echo $this->viewFrontEnd('loginView.twig');
			}else{
				header('Location: index.php?action=home');
			}

		}else{
			if (!empty($_POST['email'] && !empty($_POST['password']))) {
				$login = new UserController();
				$login->login($_POST['email'],$_POST['password']);
			}else{
				throw new Exception("Impossible de vous enregistrer, Veuillez vérifier vos informations de connection");
			}
		}
	}

	public function actionAddComment(){
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			if (!empty($_POST['author']) && !empty($_POST['comment']) && !empty($_POST['civility'])) {
				$addComment = new FrontendController();
				$addComment->addComment($_GET['id'], $_POST['author'], $_POST['comment'], $_POST['civility']);
			}
			else {
				throw new Exception("Tous les champs ne sont pas remplis !");
			}
		}
		else {
			throw new Exception("aucun identifiant de billet envoyé");
		}
	}

	public function actionDashboard(){
		$checkSession = new BackendController();
		$checkSession->checkAdminSession();
		if ($checkSession->$checkAdminSession == TRUE){
			$pageName = $_GET['action'];
			$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
			echo $this->viewBackEnd('dashboardView.twig',
				[
					'posts'=> TablePaginate::paginate('posts', 5, 'created_at DESC'),
					'comments'=> TablePaginate::paginate('comments', 3, 'comment_date DESC'),
					'page'=> $page,
					'pageName'=> $pageName,
					'nbPage'=>TablePaginate::paginate('posts', 10, 'created_at DESC')
				]);
		}else{
			header('Location: index.php?action=login');
		}
	}

	public function actionArticles(){
		$checkSession = new BackendController();
		$checkSession->checkAdminSession();
		if ($checkSession->$checkAdminSession == TRUE){
			$pageName = $_GET['action'];
			$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
			echo $this->viewBackEnd('listArticlesView.twig',
				[
					'posts'=> TablePaginate::paginate('posts', 10, 'created_at DESC'),
					'comments'=> TablePaginate::paginate('comments', 3, 'comment_date DESC'),
					'page'=> $page,
					'pageName'=> $pageName,
					'nbPage'=>TablePaginate::paginate('posts', 10, 'created_at DESC')
				]);
		}else{
			header('Location: index.php?action=login');
		}
	}

	public function actionAddArticles(){
		$checkSession = new BackendController();
		$checkSession->checkAdminSession();
		if ($checkSession->$checkAdminSession == TRUE){
			$pageName = $_GET['action'];
			$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
			echo $this->viewBackEnd('addArticleView.twig',
				[
					'posts'=> TablePaginate::paginate('posts', 10, 'created_at DESC'),
					'comments'=> TablePaginate::paginate('comments', 3, 'comment_date DESC'),
					'page'=> $page,
					'pageName'=> $pageName,
					'nbPage' => TablePaginate::paginate('posts', 10, 'created_at DESC')
				]);


            // if submit the add article form
			if (!isset($_POST['submit-article-add'])) {
                
			}else{
				if (!empty($_POST['title-article-add']) && !empty($_FILES['img-article-add']) && !empty($_POST['content-article-add'])) {
					$articleTitle = $_POST['title-article-add'];
					$articleImage = $_FILES['img-article-add'];
					$articleContent = $_POST['content-article-add'];
					$uploadMyFile = BackendController::uploadFile('img-article-add','public/assets/images/uploads/'.$articleImage["name"].'',FALSE,array('png','gif','jpg','jpeg'));
					if ($uploadMyFile) {
						echo '<script type="text/javascript"> alert("image bien enregistrer");</script>';
						BackendController::addArticle($articleTitle,'public/assets/images/uploads/'.$articleImage["name"].'',$articleContent);
					}else{
						echo '<script type="text/javascript"> alert("probleme avec l\'image");</script>';
					}
				}else{
					echo '<script type="text/javascript"> alert("champs vide");</script>';
				}
				echo '<script type="text/javascript"> alert("toucher");</script>';
			}
		}else{
			header('Location: index.php?action=login');
		}
	}

	public function actionEditArticle(){
		$checkSession = new BackendController();
		$checkSession->checkAdminSession();
		if ($checkSession->$checkAdminSession == TRUE){
			if(!empty($_GET['id']) && $_GET['id'] > 0){
				$post = new FrontendController();
				$pageName = $_GET['action'];
				$articleId = $_GET['id'];
				echo $this->viewBackEnd('editArticleView.twig',
				['post'=> $post->post()['post'],
                'comments'=> $post->post()['comments']]
				);


            // if submit the update article form
				if (!isset($_POST['submit-article-update'])) {

				}else{
					if (!empty($articleId) && !empty($_POST['title-article-update']) && !empty($_POST['content-article-update'])) {
						$articleId = $_GET['id'];
						$articleTitle = $_POST['title-article-update'];
						$articleContent = $_POST['content-article-update'];
						$articleImage = $_FILES['img-article-update'];
						if (empty($articleImage['name'])) {
							echo '<script type="text/javascript"> alert("il a compris que c\'est vide");</script>';
							BackendController::updateArticle($articleId,$articleTitle,'',$articleContent);
						}else{
							$uploadMyFile = BackendController::uploadFile('img-article-update','public/assets/images/uploads/'.$articleImage["name"].'',FALSE,array('png','gif','jpg','jpeg'));
						if ($uploadMyFile) {
							echo '<script type="text/javascript"> alert("image bien enregistrer");</script>';
							BackendController::updateArticle($articleId,$articleTitle,'public/assets/images/uploads/'.$articleImage["name"].'',$articleContent);
						}else{
							echo '<script type="text/javascript"> alert("probleme avec l\'image");</script>';
						}
						}
						
					}else{
						echo '<script type="text/javascript"> alert("champs vide");</script>';
					}
					echo '<script type="text/javascript"> alert("toucher");</script>';
				}
			}else{
				header('Location: index.php?action=login');
			}
		}else{
			header('Location: index.php?action=login');
		}
	}

	public function actionLogOut(){
		$logout = new UserController();
    	$logout->logout();
	}

	public function actionError(){
		$error = $e->getMessage();
    echo $this->viewFrontEnd('errorView.twig', ['error'=> $error]);
	}

} 

