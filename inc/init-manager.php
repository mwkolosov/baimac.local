<?php if( !defined('PATH') ) die();

	global $_INCLUDED_SCRIPTS; $_INCLUDED_SCRIPTS = array();

	function get_sources( $footer = 0 )
	{
		global $_INCLUDED_SCRIPTS;

		$output = array(
			'ext' => array(
				'scripts' => array(),
				'styles' => array()
			),
			'local' => array(
				'scripts' => array(),
				'styles' => array()
			)
		);

		$style_rails = array(); $script_rails = array();
		
		foreach( $_INCLUDED_SCRIPTS as $file )
		{
			if( $footer != $file['footer'] ) continue;

			$back = array();
			if( substr(@$file['type'], 0, 4) == "root" )
			{
				for($i = 0; $i < count(explode("/", WEBROOT)) - 1; $i++ ) $back[] = "../";
			}
			$back = implode('', $back) ."../assets/";

			$is_external = in_array( substr( $file['path'] , 0, 7), array( "http://", "https:/" ) );
			switch( @$file['type'] )
			{
				case 'style': case 'rootstyle':
					if( substr(@$file['type'], 0, 4) == "root" )
						$file['path'] = $back. "css/". $file['path'];

					if( $is_external ) $output['ext']['styles'][] = $file['path'];
					else $output['local']['styles'][ $file['index'] ][] = $file['path'];
					break;

				case 'script': case 'rootscript':
					if( substr(@$file['type'], 0, 4) == "root" )
						$file['path'] = $back. "js/". $file['path'];

					if( $is_external ) $output['ext']['scripts'][] = $file['path'];
					else $output['local']['scripts'][ $file['index'] ][] = $file['path'];
					break;
			}
			
		}

		foreach( $output['ext']['styles'] as $style ) if( $style ) print('<link href="'. $style .'" rel="stylesheet">');

		$sort = array();
		ksort($output['local']['styles']);
		foreach( $output['local']['styles'] as $item ) $sort = array_merge($sort, $item);
		$output['local']['styles'] = array( $sort );
		foreach( $output['local']['styles'] as $styles )
		{
			if( $styles )
			{
				$styles = implode(',', $styles);
				print('<link href="'. WEBROOT .'assets/styles.php?names='. urlencode($styles) .'" rel="stylesheet">');
			}
		}

		foreach( $output['ext']['scripts'] as $script ) if( $script ) print('<script src="'. $script .'"></script>');

		$sort = array();
		ksort($output['local']['scripts']);
		foreach( $output['local']['scripts'] as $item ) $sort = array_merge($sort, $item);
		$output['local']['scripts'] = array( $sort );
		foreach( $output['local']['scripts'] as $scripts )
		{
			if( $scripts )
			{
				$scripts = implode(',', $scripts);
				print('<script src="'. WEBROOT .'assets/scripts.php?names='. urlencode($scripts) .'"></script>');
			}
		}
	}

	function _add_resource( $type, $file, $footer = 0, $index = 10 )
	{
		global $_INCLUDED_SCRIPTS;

		if( defined('MDL_HOOKS') && !MdlHook()->express('pagebuilder.regres', array( $type, $file, $footer, $index )) )
			return false;

		if( !in_array($file, $_INCLUDED_SCRIPTS) )
			$_INCLUDED_SCRIPTS[] = array(
				'type' => $type,
				'path' => $file,
				'index' => $index,
				'footer' => $footer
			);
	}



	function get_header() { MdlHook()->express('pagebuilder.header'); include( PATH . '/header.php' ); }
	function get_footer() { MdlHook()->express('pagebuilder.footer'); include( PATH . '/footer.php' ); }

	function enable_mysql() { include( INC_PATH . '/init-database.php' ); }
	function enable_hooks() { include( INC_PATH . '/init-hooks.php' ); }
	function enable_ajax()
	{
		include( INC_PATH . '/init-ajax.php' );
		MdlHook()->listen('pagebuilder.init.pre', 'call_ajax');
	}

	function enable_errors()
	{
		ini_set('session.gc_maxlifetime', 3600);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
	}
	
	function enable_modules()
	{
		$_modules_path = INC_PATH ."/modules";
		if( !file_exists($_modules_path) ) return false;

		foreach( scandir($_modules_path) as $file )
		{
			if( $file == "." || $file == ".." || $file == "guide.php" ) continue;
			if( filetype( $_modules_path ."/". $file ) == "file" )
				require_once $_modules_path ."/". $file;
		}
	}

	function enable_pagebuilder()
	{
		global $_URL, $_PAGE, $_PAGE_PATH, $_PAGE_ID, $_PAGE_BACK, $_PAGE_FRONT, $_QUERY;

		$_PATH = dirname(__FILE__). "/.." . WEBROOT;
		$_PAGE = new PageBuilder;

		$_URL = str_replace(WEBROOT, "/", $_SERVER['REQUEST_URI']);
		$_URL = !substr_count($_URL, '?') ? $_URL : substr($_URL, 0, strpos($_URL, "?"));
		$_URL = substr($_URL, 1, strlen($_URL) - 2 );
		$_URL = $_URL ? $_URL : "home";
		$_QUERY = array();

		$index = 0;
		$url = explode('/', $_URL);
		while( $index < count( $url ) )
		{
			$path = implode("/", array_slice($url, 0, count( $url ) - $index));
			if( !$_PAGE_FRONT && file_exists($_PATH ."/model/front/$path.php") ) $_PAGE_FRONT = $path;
			if( !$_PAGE_BACK && file_exists($_PATH ."/model/back/$path.php") ) $_PAGE_BACK = $path;
			if( $_PAGE_FRONT && $_PAGE_BACK ) break;
			$index++;
		}

		if( $_PAGE_BACK )
		{
			if( $_PAGE_FRONT != $_URL )
			{
				if( @get_page_back($_PAGE_BACK)->deep !== true )
				{
					$_PAGE_BACK = "404";
					$_PAGE_FRONT = "404";
				}
				else
				{
					$_QUERY = explode('/', substr(str_replace($_PAGE_FRONT, "", $_URL), 1));
				}
			}

			require_once( $_PATH ."/model/back/$_PAGE_BACK.php" );
			$_PAGE = new Page;
		}
		
		$url = file_exists($_PATH ."/model/front/$_PAGE_FRONT.php") ? $_PAGE_FRONT : "404";
		$_PAGE_PATH = $_PATH ."/model/front/$url.php";

		$_PAGE->_pre();
		if( !defined('MDL_HOOKS') || MdlHook()->express('pagebuilder.init.pre') )
		{
			if( file_exists($_PATH ."/assets/css/front/$url.css") )
				_add_resource('style', "front/$url.css", 1, 11);

			if( file_exists($_PATH ."/assets/js/front/$url.js") )
				_add_resource('script', "front/$url.js", 1, 11);
		}
	}



	/**
	 * Получает объект back-обработчика страницы
	 *
	 * @return {Class} Объект back-обработчика страницы.
	 */
	function get_page_back( $page )
	{
		return json_decode( file_get_contents( WEBDOMAIN ."/?__gpb=$page" ) );
	}

	if( @$_GET['__gpb'] )
	{
		header( 'Content-Type: application/json' );
		require_once( dirname(__FILE__). "/.." . WEBROOT ."/model/back/". _valid($_GET['__gpb']) .".php" );
		exit( json_encode( new Page ) );
	}



	class PageBuilder
	{
		function _pre() { }
		function _init() { }
		function _post() { }

		function get_title() { if( @$this->title ) print( htmlspecialchars($this->title) ); }
		function get_desc() { if( @$this->desc ) print( htmlspecialchars($this->desc) ); }
		function get_keywords() { if( @$this->keywords ) print( htmlspecialchars($this->keywords) ); }
	}
?>