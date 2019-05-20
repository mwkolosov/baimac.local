<?php
	class Page extends PageBuilder
	{
		public $title = "Error 404. Page not found!";

		function _pre()
		{
			header('HTTP/1.0 404 Not Found');
		}
	}
?>