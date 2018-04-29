<?php
namespace blog\src\controller;

use blog\src\controller\UserController;
use blog\src\controller\ArticleController;
use blog\src\tools\GoogleTranslate;
use blog\src\tools\TablePaginate;
use blog\src\tools\UploadFile;
use blog\src\tools\EmailMe;
use blog\src\tools\CheckSession;

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
	
	/*************************************** TWIG FRONTEND ENVIRONEMENT ****************************************/
	/**
	 * This function will render twig frontend views
	 * @param  string $page   the page to view
	 * @param  array  $params the params added to this view.
	 * @return string         the final page to view with it's params.
	 */
	public function viewFrontEnd(string $page, array $params = array())

	{
		$this->loader = new \Twig_Loader_Filesystem('src/view/frontend');
		$this->twig = new \Twig_Environment($this->loader, array(
	    	//'cache' => false,
		));
		$this->twig->addGlobal('session', $_SESSION);
		$this->viewFrontPage = $this->twig->render($page,$params);
		return $this->viewFrontPage;
	}

	/*************************************** TWIG BACKEND ENVIRONEMENT ****************************************/
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
	
	/*************************************** TRANSLATE ACTION *******************************************/

	public function actionTranslate()
	{
		$translate = $_GET['data'];
		$lang = $_GET['lang'];
		$result = GoogleTranslate::translate('auto',$lang,$translate);
		echo $result;
	}

    /*************************************** HOME ACTION ***********************************************/

	public function actionHome(){
		$pageName = $_GET['action'];
		$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
        echo $this->viewFrontEnd(
        	'homeView.twig', 
        	['posts'=> TablePaginate::paginate('posts', 8, 'created_at DESC'),
        	'nbPage'=>TablePaginate::paginate('posts', 8, 'created_at DESC'),
        	'page'=> $page,
			'pageName'=> $pageName]);
	}

    /*************************************** ABOUT ACTION ***********************************************/

	public function actionAbout(){
        echo $this->viewFrontEnd('about.twig');
	}

    /*************************************** BLOG ACTION ***********************************************/

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

    /*************************************** PORTFOLIO ACTION ******************************************/

	public function actionPortfolio(){
        echo $this->viewFrontEnd('portfolio.twig');
	}

    /*************************************** CONTACT ACTION *******************************************/

	public function actionContact(){
        if (!isset($_POST['contact-submit'])) {
			echo $this->viewFrontEnd('contact.twig');
		}
		else{
			//$role = "visitor";
			if (!empty($_POST['contact-name']) && !empty($_POST['contact-email']) && !empty($_POST['contact-phone']) && !empty($_POST['contact-message'])) {
				
				
					EmailMe::sendMessageMail('sabri@hamda.ch',
						'Nom : '.$_POST['contact-name'].
						'<br> Email : '.$_POST['contact-email'].
						'<br> Phone : '.$_POST['contact-phone'].
						'<br> Message : '.$_POST['contact-message'],
						'Vous avez reçu un message de '.$_POST['contact-name']); 

					echo $this->viewFrontEnd('contact.twig',['confirmation'=> 'Message envoyé']);
				
			}else {
				throw new \Exception("Impossible d'envoyer, Tous les champs ne sont pas remplis !");
			}
		}
	}

	/*************************************** ARTICLE ACTION ***********************************************/

	public function actionArticle(){
		if (isset($_GET['id']) && $_GET['id'] > 0 && preg_match("#^\d+$#", $_GET['id'])) {
			$articleId = $_GET['id'];
			$article = new ArticleController();
			echo $this->viewFrontEnd(
				'postView.twig',
				['post'=> $article->article($articleId)['post'],
				'comments'=> $article->article($articleId)['comments']]
			);
		}
		else {
			throw new \Exception("aucun identifiant d'article envoyé");
		}
	}

    /*************************************** REGISTER ACTION ********************************************/

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
					EmailMe::sendTemplateMail('sabri@hamda.ch','src/view/mail/registerMailView.twig','Bonjour '.$_POST['prenom']); 
					echo $this->viewFrontEnd('registerView.twig',['prenom'=> $prenom]);
				}
				else {
					throw new \Exception("Impossible de vous enregistrer, Les deux mot des passe ne sont pas identique");
				}
			}else {
				throw new \Exception("Impossible de vous enregistrer, Tous les champs ne sont pas remplis !");
			}
		}
	}

    /*************************************** LOGIN ACTION ***********************************************/

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
				throw new \Exception("Impossible de vous enregistrer, Veuillez vérifier vos informations de connection");
			}
		}
	}

    /*************************************** ADDCOMMENT ACTION ****************************************/    

	public function actionAddComment(){
		if (isset($_GET['id']) && $_GET['id'] > 0 && preg_match("#^\d+$#", $_GET['id'])) {
			if (!empty($_SESSION['prenom']) && !empty($_POST['comment']) && !empty($_SESSION['civility'])) {
				$addComment = new CommentController();
				$addComment->addComment($_GET['id'], $_SESSION['prenom'], $_POST['comment'], $_SESSION['civility'], $_SESSION['role']);
			}
			else {
				throw new \Exception("Votre commentaire est vide !");
			}
		}
		else {
			throw new \Exception("aucun identifiant de billet envoyé");
		}
	}

    /*************************************** DASHBOARD ACTION *******************************************/

	public function actionDashboard(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
			$pageName = $_GET['action'];
			$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
			echo $this->viewBackEnd('dashboardView.twig',
				[
					'posts'=> TablePaginate::paginate('posts', 5, 'created_at DESC'),
					'comments'=> TablePaginate::paginate('comments', 10, 'comment_date DESC'),
					'page'=> $page,
					'pageName'=> $pageName,
					'nbPage'=>TablePaginate::paginate('posts', 10, 'created_at DESC')
				]);
		}else{
			header('Location: index.php?action=login');
		}
	}

	/*************************************** COMMENTS ACTION ********************************************/    

	public function actionComments(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
			$pageName = $_GET['action'];
			$page = empty($_GET['page']) ? 0 : $_GET['page']-1;
			echo $this->viewBackEnd('listCommentsView.twig',
				[
					'posts'=> TablePaginate::paginate('posts', 10, 'created_at DESC'),
					'comments'=> TablePaginate::paginate('comments', 10, 'comment_date DESC'),
					'page'=> $page,
					'pageName'=> $pageName,
					'nbPage'=>TablePaginate::paginate('posts', 10, 'created_at DESC')
				]);
		}else{
			header('Location: index.php?action=login');
		}
	}

	/*************************************** VALIDATE-COMMENT ACTION ********************************************/    

	public function actionValidateComment(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				$id = $_GET['id'];
				$validateComment = new CommentController();
				$validateComment->validateThisComment($id);
				header('Location: index.php?action=dashboard');
			}
			else {
				throw new \Exception("operation impossible id incorrecte");

			}
		}else{
			header('Location: index.php?action=login');
		}

	}

    /*************************************** ARTICLES ACTION ********************************************/    

	public function actionArticles(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
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

    /*************************************** ADD ARTICLE ACTION ***************************************/    

	public function actionAddArticle(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
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
				if (!empty($_POST['title-article-add']) && !empty($_FILES['img-article-add']) && !empty($_POST['content-article-add']) && !empty($_POST['content-right-article-add'])) {
					$articleTitle = $_POST['title-article-add'];
					$articleImage = $_FILES['img-article-add'];
					$articleContent = $_POST['content-article-add'];
					$articleContentRight = $_POST['content-right-article-add'];
					$uploadMyFile = UploadFile::uploadFile('img-article-add','public/assets/images/uploads/'.$articleImage["name"].'',FALSE,array('png','gif','jpg','jpeg'));
					if ($uploadMyFile) {
						echo '<script type="text/javascript"> alert("image bien enregistrer");</script>';
						ArticleController::addArticle($articleTitle,'public/assets/images/uploads/'.$articleImage["name"].'',$articleContent,$articleContentRight);
							echo '<script type="text/javascript"> window.location.replace("index.php?action=dashboard");</script>';
					}else{
						echo '<script type="text/javascript"> alert("probleme avec l\'image");</script>';
					}
				}else{
					echo '<script type="text/javascript"> alert("Veuillez remplir tous les champs");</script>';
				}
				//echo '<script type="text/javascript"> alert("toucher");</script>';
			}
		}else{
			header('Location: index.php?action=login');
		}
	}

    /*************************************** UPDATE ARTICLE ACTION ************************************/

	public function actionEditArticle(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
			if(!empty($_GET['id']) && $_GET['id'] > 0 && preg_match("#^\d+$#", $_GET['id'])){
				$article = new ArticleController();
				$pageName = $_GET['action'];
				$articleId = $_GET['id'];
				echo $this->viewBackEnd('editArticleView.twig',
					[
					'posts'=> TablePaginate::paginate('posts', 10, 'created_at DESC'),	
					'post'=> $article->article($articleId)['post'],
            		'comments'=> TablePaginate::paginate('comments', 3, 'comment_date DESC'),
					'page'=> $page,
					'pageName'=> $pageName,
					'nbPage' => TablePaginate::paginate('posts', 10, 'created_at DESC')
				]);


            // if submit the update article form
				if (!isset($_POST['submit-article-update'])) {

				}else{
					if (!empty($articleId) && !empty($_POST['title-article-update']) && !empty($_POST['content-article-update']) && !empty($_POST['content-right-article-update'])) {
						$articleId = $_GET['id'];
						$articleTitle = $_POST['title-article-update'];
						$articleContent = $_POST['content-article-update'];
						$articleContentRight = $_POST['content-right-article-update'];

						$articleImage = $_FILES['img-article-update'];
						if (empty($articleImage['name'])) {
							ArticleController::updateArticle($articleId,$articleTitle,'',$articleContent,$articleContentRight);
							echo '<script type="text/javascript"> window.location.replace("index.php?action=edit-article&id='.$articleId.'");</script>';
						}else{
							$uploadMyFile = UploadFile::uploadFile('img-article-update','public/assets/images/uploads/'.$articleImage["name"].'',FALSE,array('png','gif','jpg','jpeg'));
							if ($uploadMyFile) {
								echo '<script type="text/javascript"> alert("image bien enregistrer");</script>';
								ArticleController::updateArticle($articleId,$articleTitle,'public/assets/images/uploads/'.$articleImage["name"].'',$articleContent,$articleContentRight);
								echo '<script type="text/javascript"> window.location.replace("index.php?action=edit-article&id='.$articleId.'");</script>';
							}else{
								echo '<script type="text/javascript"> alert("probleme avec l\'image");</script>';
							}
						}
						
					}else{
						echo '<script type="text/javascript"> alert("champs vide");</script>';
					}
					//echo '<script type="text/javascript"> alert("toucher");</script>';
				}
			}else{
				header('Location: index.php?action=login');
			}
		}else{
			header('Location: index.php?action=login');
		}
	}
	/*************************************** DELETE ARTICLE ACTION ***************************************/
	public function actionDelArticle(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
			if (isset($_GET['id']) && $_GET['id'] > 0 && preg_match("#^\d+$#", $_GET['id'])) {
				$articleId = $_GET['id'];
			    ArticleController::deleteArticle($articleId);
				echo '<script type="text/javascript"> window.location.replace("index.php?action=dashboard");</script>';
				echo '<script type="text/javascript"> alert("Article suprimer avec succès");</script>';
			}else{
				echo '<script type="text/javascript"> window.location.replace("index.php?action=dashboard");</script>';
				echo '<script type="text/javascript"> alert("Aucun Article a suprimer");</script>';

			}
			
		}else{
			header('Location: index.php?action=login');
		}

	}

		/*************************************** DELETE COMMENT ACTION ***************************************/
	public function actionDelComment(){
		$checkSession = CheckSession::checkAdminSession();
		if ($checkSession == TRUE){
			if (isset($_GET['id']) && $_GET['id'] > 0 && preg_match("#^\d+$#", $_GET['id'])) {
				$commentId = $_GET['id'];
			    CommentController::deleteComment($commentId);
				echo '<script type="text/javascript"> window.location.replace("index.php?action=dashboard");</script>';
				echo '<script type="text/javascript"> alert("Commentaire suprimer avec succès");</script>';
			}else{
				echo '<script type="text/javascript"> window.location.replace("index.php?action=dashboard");</script>';
				echo '<script type="text/javascript"> alert("Aucun Commentaire a suprimer");</script>';

			}
			
		}else{
			header('Location: index.php?action=login');
		}

	}

    /*************************************** LOGOUT ACTION ***********************************************/

	public function actionLogOut(){
		$logout = new UserController();
    	$logout->logout();
	}

    /*************************************** ERRORS ACTION ********************************************/

	public function actionError($e){
		$error = $e->getMessage();
    echo $this->viewFrontEnd('errorView.twig', ['error'=> $error]);
	}

} 

