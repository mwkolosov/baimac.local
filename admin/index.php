<?php
	@session_start();
	include('main.php');

	if( !$mydb->table_exists("sudoers") )
	{
		$mydb->table_create('sudoers', array(
			'id' => array( 'type' => "int", 'pars' => "ai,us,pk" ),
			'name' => "text",
			'email' => "text",
			'login' => "text",
			'password' => "text",
			'role' => "text",
			'avatar' => "text",
			'active' => "boolean"
		));
	}

	if( !in_array($_PAGE_FRONT, array('login')) && !isset($_SESSION['baimacer']) )
		_location('/admin/login/');

	_add_resource('rootstyle', "imports.css", 1, 1);
	_add_resource('style', "main.css", 1);
	_add_resource('style', "mobile.main.css", 1);
	_add_resource('rootstyle', "plugins/jquery-ui.min.css", 1);
	_add_resource('rootstyle', "plugins/jquery-ui.structure.css", 1);

	_add_resource('rootscript', "jquery.js", 1);
	_add_resource('script', "main.js", 1);

	include('../index.php');
?>