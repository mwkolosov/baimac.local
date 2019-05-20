<?php if( !defined('PATH') ) die();

	define('MDL_HOOKS', true);

	global $MdlHook;
	function MdlHook()
	{
		global $MdlHook;
		if( !$MdlHook ) $MdlHook = new MdlHook();
		return $MdlHook;
	}

	class MdlHook
	{
		private $listening_hooks = array();

		function listen($hook, $action)
		{
			if( !in_array($hook, array_keys($this->listening_hooks)) )
				$this->listening_hooks[$hook] = array();

			$this->listening_hooks[$hook][] = $action;
		}

		function express($hook, $args = array())
		{
			if( in_array($hook, array_keys($this->listening_hooks)) )
			foreach( $this->listening_hooks[$hook] as $ears )
			{
				if( call_user_func_array( $ears, $args ) === false ) return false;
			}

			return true;
		}
	}
?>