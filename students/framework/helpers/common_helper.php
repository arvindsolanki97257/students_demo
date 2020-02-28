<?php
require_once ("application/config/access.php");

### Check Access
function hasAccess($class,$method)
{	
	//print_r($GLOBALS['access']);
	$checkMethod = $GLOBALS['access'];
	

	if (array_key_exists(PLATFORM."_".$class,$checkMethod))
	{
		$checkMethod = $checkMethod[PLATFORM."_".$class];
		if (array_key_exists($method,$checkMethod))
		{	
			$controller = new $class;
			$controller->$method();
			$key_exists=1;
		}
		else
		{	
			$key_exists=0;
		}
	}
	else
	{
		$key_exists=0;
	}
	if($key_exists==0)
	{
		// redirect to respective index page for backend/frontend
		if(PLATFORM=="admin")
		{
			header("location: index.php?p=admin&c=Index&a=index");exit;
		}
		else
		{
			header("location: index.php?p=home&c=Index&a=index");exit;
		}
	}

}
?>