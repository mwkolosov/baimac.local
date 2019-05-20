<?php
	class Page extends PageBuilder
	{
		public $title = "Admin Baimac - Login";

		function _pre()
		{
			global $mydb, $_msg;

			if( isset($_POST) && isset($_POST['fl-login']) && isset($_POST['fl-pass']) )
			{
				$post = _valid($_POST, 1);

				$login = $post['fl-login'];
				$user = $mydb->get("SELECT * FROM sudoers WHERE login='$login' OR email='$login'");

				if( count($user) && $user[0]['password'] == _passhash( $user[0]['login'], $post['fl-pass'] ) )
				{
					$_SESSION['baimacer'] = $user[0]['id'];
					$_SESSION['baimacer-pass'] = $user[0]['password'];
					header('Location: /admin/');
				}
				else $_msg = array( 'type' => "error", 'msg' => "Неверный логин/пароль" );
			}

			MdlHook()->listen('pagebuilder.header.pre', function() { return false; });
			MdlHook()->listen('pagebuilder.footer.pre', function() { return false; });
		}
	}
?>