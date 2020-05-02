<?php

class Utils
{
	public static function redirection($to)
	{
		header('Location: ' . URL_BASE . $to);
	}

	public static function postValue($postFieldName){
		if(!isset($_POST) || !isset($_POST[$postFieldName])){
			return '';
		}
		return $_POST[$postFieldName];
	}

	public static function menuActive($page){
		if(isset($_GET['controller']) && $_GET['controller']==$page){
			return 'active';
		}
		return '';
	}
}

?>