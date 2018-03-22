<?php
namespace blog\src\controller;


/**
* 
*/
class Controller 
{

protected $loader;
protected $twig;


	function __construct($loader,$twig)
	{
		$this->$loader = new \Twig_Loader_Filesystem('src/view/frontend');

		$this->$twig = new \Twig_Environment($this->$loader, array(
    	//'cache' => false,
		));

		return $twig;

		
	}

} 

	