<?php
namespace blog\src\controller;
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

} 

