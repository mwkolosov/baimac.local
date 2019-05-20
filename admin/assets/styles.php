<?php
	header("Content-Type: text/css; charset=UTF-8");

	function compress($buffer)
	{
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

		return $buffer;
	}
	ob_start("compress");
	
	if( @$_GET['names'] )
	{
		$_resourse_dir = "./css/";
		foreach( explode(',', $_GET['names']) as $resourse )
		{
			$path = $_resourse_dir . trim(urldecode($resourse));
			if( file_exists($path) ) require_once( $path );
		}
	}

	ob_end_flush();
?>