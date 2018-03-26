<?php
namespace blog\src\controller;
/**
* This Class is the main controller of the application.
*/
class Controller 
{

protected $loader;
protected $twig;

/**
 * Configure Twig to load templates.
 * @param obj $loader looks up the templates in the /src/view/frontend/ folder.
 * @param obj $twig   Twig uses a central object called the environment (of class Twig_Environment). Instances of this class are used to store the configuration and extensions, and are used to load templates from the file system or other locations.
 */
	function __construct($loader,$twig)
	{
		$this->$loader = new \Twig_Loader_Filesystem('src/view/frontend');

		$this->$twig = new \Twig_Environment($this->$loader, array(
    	//'cache' => false,
		));

		

		return $twig;

		
	}

} 

	