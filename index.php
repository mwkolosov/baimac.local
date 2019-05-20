<?php
	@session_start();
	if( !defined('PATH') ) include('main.php');

	if( WEBROOT == "/" )
	{
		_add_resource('rootstyle', "normalize.css", 1,2);
		_add_resource('rootstyle', "imports.css", 1, 1);
		_add_resource('rootstyle', "main.css", 1);
		_add_resource('rootstyle', "mobile.main.css", 1);
		_add_resource('rootstyle', "plugins/jquery-ui.min.css", 1);
		_add_resource('rootstyle', "plugins/jquery-ui.structure.css", 1);
		_add_resource('rootstyle', "plugins/bootstrap/bootstrap.min.css", 1);
		_add_resource('rootstyle', "plugins/fancybox/jquery.fancybox.min.css", 1);
		_add_resource('rootstyle', "plugins/owl/owl.carousel.min.css", 1);
		_add_resource('rootstyle', "header.css", 1);
		_add_resource('rootstyle', "footer.css", 1);


		_add_resource('rootscript', "jquery.js", 1);
		_add_resource('rootscript', "main.js", 1);
		_add_resource('rootscript', "plugins/bootstrap/bootstrap.min.js", 1);
		_add_resource('rootscript', "plugins/fancybox/jquery.fancybox.min.js", 1);
		_add_resource('rootscript', "plugins/owl/owl.carousel.min.js", 1);
		_add_resource('rootscript', "plugins/popper/popper.min.js", 1,1);
	}
?>
<?php ob_start("html_compress"); ?>
<!DOCTYPE html>
<html lang="ru">

	<head>
		<meta charset="utf-8">
	    <meta name="format-detection" content="telephone=no">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="<?php $_PAGE->get_desc() ?>">
	    <meta name="keywords" content="<?php $_PAGE->get_keywords() ?>">

		<title><?php $_PAGE->get_title() ?></title>
		
		<?php if( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.head.sources') ) get_sources(); ?>

		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">

    </head>

	<body>
		<?php if( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.header.pre') ): ?>
		<header id="main-header"> <?php get_header(); ?> </header>
		<?php endif; ?>

		<main>
			<?php
				if( file_exists($_PAGE_PATH) && ( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.init') ) )
					require $_PAGE_PATH;
			?>
		</main>

		<?php if( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.footer.pre') ): ?>
		<footer id="main-footer"> <?php get_footer(); ?> </footer>
		<?php endif; ?>

		<?php if( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.footer.sources') ): ?>
		<footer> <?php get_sources(1); ?> </footer>
		<?php endif; ?>
	</body>
</html>
<?php
	if( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.init.post') )
		$_PAGE->_post();

	ob_end_flush();
?>