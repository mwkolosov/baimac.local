<?php if( !defined('PATH') ) die();

	define('MYSQLI_MODE', class_exists("mysqli"));

	class mydb
	{
		private $_server;
		private $_dbname;
		private $_login;
		private $_pass;
		private $_port;
		private $_link;

		public $insert_id;

		function __construct( $host, $login, $pass, $dbname, $port = 3306 )
		{
			$this->_dbname = $dbname;
			$this->_server = $host;
			$this->_login = $login;
			$this->_pass = $pass;
			$this->_port = $port;

			if( MYSQLI_MODE )
			{
				$this->_link = new mysqli($host, $login, $pass, $dbname)
					or die("Can't connect to DB");
			}
			else
			{
				$this->_link = mysql_connect($host, $login, $pass)
					or die("Can't connect to DB");
				mysql_select_db($dbname);
			}

			$this->query("SET NAMES 'utf8'");
			$this->query("SET CHARACTER SET 'utf8'");
		}



		function query( $sql )
		{
			$result = MYSQLI_MODE ? $this->_link->query( $sql ) : mysql_query( $sql );
			$this->insert_id = MYSQLI_MODE ? $this->_link->insert_id : mysql_insert_id();
			return $result;
		}



		function get( $sql, $start = -1, $length = false )
		{
			$result = array();
			$resultQuery = $this->query( $sql );
			if( MYSQLI_MODE )
			{
				while( $resultQuery && $row = $resultQuery->fetch_assoc() )
					$result[] = $row;
			}
			else
			{
				while( $resultQuery && $row = mysql_fetch_assoc($resultQuery) )
					$result[] = $row;
			}

			return !$length ?
				( $start >= 0 && $start < count($result) ?
					$result[$start] : $result
				) :
				array_slice($result, $start, $length);
		}



		function insert( $tname, $data )
		{
			$columns = array(); $values = array();
			foreach( $data as $c => $v )
			{
				$columns[] = "`". $c ."`";
				$values[] = "'". $v ."'";
			}
			$columns = implode(",", $columns);
			$values = implode(",", $values);

			return $this->query("INSERT INTO ". $tname ." ($columns) VALUES ($values)");
		}



		function update( $tname, $data, $where )
		{
			$values = array(); $wheres = array();
			foreach( $data as $c => $v ) $values[] = "$c=".( $v == "NULL" ? $v : "'$v'" )."";
			foreach( $where as $c => $v ) $wheres[] = "$c=".( $v == "NULL" ? $v : "'$v'" )."";
			$values = implode(", ", $values);
			$wheres = implode(" AND ", $wheres);

			return $this->query("UPDATE ". $tname ." SET $values WHERE $wheres");
		}



		function table_exists( $table )
		{
			return !!count( $this->get("SHOW TABLES LIKE '$table'") );
		}



		function table_create( $table, $params )
		{
			$values = array();
			foreach( $params as $c => $v )
			{
				if( is_string($v) ) $values[] = $this->table_retypes("$c $v");
				elseif( is_array($v) )
				{
					if( !@$v['type'] ) continue;

					$pars = array();
					if( @$v['length'] )
						$pars[] = $this->table_retypes($v['type']) ."(". $v['length'] .")";
					else
						$pars[] = $this->table_retypes($v['type']);

					if( @$v['pars'] )
					{
						$v['pars'] = explode(',', str_replace(" ", "", $v['pars']));
						if( in_array('unsigned', $v['pars']) || in_array('us', $v['pars']) )
							$pars[] = "UNSIGNED";
						if( in_array('auto_increment', $v['pars']) || in_array('ai', $v['pars']) )
							$pars[] = "AUTO_INCREMENT";
						if( in_array('notnull', $v['pars']) || in_array('nn', $v['pars']) )
							$pars[] = "NOT NULL";
						if( in_array('null', $v['pars']) || in_array('dn', $v['pars']) )
							$pars[] = "DEFAULT NULL";
						if( in_array('primary', $v['pars']) || in_array('pk', $v['pars']) )
							$pars[] = "PRIMARY KEY";
					}

					$values[] = "$c ". implode(' ', $pars);
				}
			}
			$values = implode(", ", $values);

			return $this->query("CREATE TABLE IF NOT EXISTS $table ($values)");
		}



		function table_retypes( $str )
		{
			$str = preg_replace('/boolean/i', "TINYINT(1)", $str);
			$str = preg_replace('/text/i', "TEXT", $str);
			$str = preg_replace('/int/i', "INT", $str);

			return $str;
		}
	}

	global $mydb; $mydb = new mydb(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
?>