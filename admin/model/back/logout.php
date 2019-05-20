<?php
	class Page extends PageBuilder
	{
		public $title = "Admin Baimac - Logout";

		function _pre()
		{
			unset( $_SESSION['baimacer'] );
			session_unset('manager');
			unset( $_SESSION['baimacer-pass'] );
			session_unset('baimacer-pass');

			header('Location: /admin/login/');
		}
	}
?>