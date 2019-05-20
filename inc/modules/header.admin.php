<?php
	global $_FRONT_ADMIN, $mydb;
	if( isset($_SESSION['baimacer']) )
	{
		$_FRONT_ADMIN = $mydb->get(
			"SELECT * FROM sudoers WHERE id='". $_SESSION['baimacer'] ."' AND password='". $_SESSION['baimacer-pass'] ."'"
		);

		if( !count($_FRONT_ADMIN) ) exit( header("Location: /admin/logout/") );
		$_FRONT_ADMIN = (object) $_FRONT_ADMIN[0];
	}

	MdlHook()->listen('pagebuilder.init.pre', function()
	{
		global $_FRONT_ADMIN;
		if( @$_FRONT_ADMIN->id && WEBROOT == "/" )
		{
			_add_resource('rootstyle', "modules/header.admin.css", 1, 11);
			_add_resource('rootscript', "plugins/jquery.ui.interactions.js", 1, 11);
			_add_resource('rootscript', "modules/header.admin.js", 1, 11);
		}
	});

	MdlHook()->listen('pagebuilder.header', function()
	{
		global $_FRONT_ADMIN;

		if( @$_FRONT_ADMIN->id && WEBROOT == "/" ): ?>

		<div id="md-header-admin"> <a href="/admin/">
			<img src="<?= @$_FRONT_ADMIN->avatar ?: _imaged('/admin/assets/media/logo.png', "80xauto") ?>">
		</a> </div>

		<?php endif;
	});
?>