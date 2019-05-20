<?php if( !defined('PATH') ) die();

	global $_AJAX;
	function add_action($action, $func)
	{ global $_AJAX; $_AJAX[$action] = $func; }

	function call_ajax()
	{
		global $_AJAX;
		if( $_POST && isset($_POST['action']) )
		{
			if( is_callable( $_AJAX['ajax.'. $_POST['action']] ) )
				$_AJAX['ajax.'. $_POST['action']]();

			else
				call_user_func( $_AJAX['ajax.'. $_POST['action']] );
			
			exit;
		}
	}
?>