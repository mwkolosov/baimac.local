<?php
	header("Content-Type: application/javascript; charset=UTF-8");

	use MatthiasMullie\Minify;

	require('../inc/Minify/src/Minify.php');
	require('../inc/Minify/src/JS.php');
	require('../inc/Minify/src/Exception.php');

	$minifier = new Minify\JS();

	if( @$_GET['names'] )
	{
		$_resourse_dir = "./js/";
		$minifier = new Minify\JS();
		
		foreach( explode(',', $_GET['names']) as $resourse )
		{
			$path = $_resourse_dir . trim(urldecode($resourse));
			if( file_exists($path) ) $minifier->add( $path );
		}

		echo $minifier->minify();
	}
?>