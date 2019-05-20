<?php
	define('PATH', dirname(__FILE__) );
	define('INC_PATH', PATH ."/inc" );
	define('THUMBS_PATH', "/assets/media/thumbs/" );

	define('WEBROOT', "/" );
	define('WEBDOMAIN', "http://". $_SERVER['HTTP_HOST'] );

	# Control Constants
	{
		define('GOOGLE_API_KEY', "" );
	}

	include(INC_PATH . "/utils.php");
	include(INC_PATH . "/init-manager.php");


	# Database Constants
	{
		define('DB_SERVER', "localhost");
		define('DB_USER', "baimac.ddns.net");
		define('DB_PASS', "Nps1914MaGaK");
		define('DB_NAME', "host_baimac");
	}


	# Site modules pre-load
	{
		enable_errors();
		enable_hooks();
		enable_ajax();
		enable_mysql();
		enable_modules();
		enable_pagebuilder();
	}


	# Ajax functions
	{
		add_action('ajax.action', function()
		{
			
		});
	}


	call_ajax();
?>