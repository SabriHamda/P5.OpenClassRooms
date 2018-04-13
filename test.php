<?php
use blog\src\tools\GoogleTranslate;
use blog\src\controller\Controller;

require_once('vendor/autoload.php');

if(isset($_GET['translate'])){
	$translate = $_GET['translate'];
	$result = GoogleTranslate::translate('auto','fr',$translate);
	echo $result;
}else{
	return 'no result con va';
}




