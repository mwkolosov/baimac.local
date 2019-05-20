<?php
	define('PATH', dirname(__FILE__) );
	define('INC_PATH', PATH ."/../inc" );
	define('THUMBS_PATH', "/assets/media/thumbs/" );

	define('WEBROOT', "/admin/" );
	define('WEBDOMAIN', "http://". $_SERVER['HTTP_HOST'] );

	# Control Constants
	{
		define('GOOGLE_API_KEY', "" );

		global $_ADM_ROLES; $_ADM_ROLES = array(
			'admin' => "Администратор",
			'editor' => "Редактор",
			'viewer' => "Посетитель",
		);
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


	# User-object
	{
		global $_USER, $mydb;
		if( isset($_SESSION['baimacer']) )
		{
			if( !isset($_SESSION['baimacer-pass']) ) exit( header("Location: /admin/logout/") );

			$_USER = $mydb->get(
				"SELECT * FROM sudoers WHERE id='". $_SESSION['baimacer'] ."' AND password='". $_SESSION['baimacer-pass'] ."'"
			);

			if( !count($_USER) ) exit( header("Location: /admin/logout/") );
			$_USER = (object) $_USER[0];
		}
	}


	# Ajax functions
	{
		// add_action('ajax.user.remove', function()
		// {
		// 	$out = array( 'msg' => "SUCCESS" );



		// 	_json( $out );
		// });
	}
?>