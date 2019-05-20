<?php
	class Page extends PageBuilder
	{
		public $title = "Admin Baimac - Users";

		function _pre()
		{
			add_action('ajax.user.remove', function()
			{
				header('Content-Type: application/json');
				$out = array( 'msg' => "SUCCESS" );

				

				_json( $out );
			});
		}
	}
?>