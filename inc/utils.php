<?php if( !defined('PATH') ) die();

	function catch_fatal_error()
	{
		if( @$_SESSION['manager'] == 1 ) return;

		$last_error =  error_get_last();

		if( isset($last_error['type']) && $last_error['type'] == E_ERROR )
		{
			$txt = $last_error['message'];
			$txt .= ", File: ". $last_error['file'];
			$txt .= ", On line: ". $last_error['line'];
			mail("gmdragonx@gmail.com", "Fatal error on Gladsal Cabinet", $txt);
		}
	}
	register_shutdown_function('catch_fatal_error');



	/**
	 * Проверяет, запущен ли процесс на сервере по PID
	 *
	 * @param {number} pid PID процесса
	 * @param {mixed} result Output
	 * @return {mixed} True, если процесс запущен.
	 */
	function _is_running($pid, &$result)
	{
	    try
	    {
	        $result = shell_exec(sprintf("ps %d", $pid));
	        if( count(preg_split("/\n/", $result)) > 2 ) return true;
	    }
	    catch( Exception $e ){}

	    return false;
	}
	
	
	
	/**
	 * Определяет использование мобильного браузера
	 *
	 * @return {mixed} True, если браузер мобильный.
	 */
	function is_mobile_android() { return preg_match("/Android/", $_SERVER[HTTP_USER_AGENT]); }
	function is_mobile_blackberry() { return preg_match("/BlackBerry/", $_SERVER[HTTP_USER_AGENT]); }
	function is_mobile_ios() { return preg_match("/iPhone|iPad|iPod/", $_SERVER[HTTP_USER_AGENT]); }
	function is_mobile_opera() { return preg_match("/Opera Mini/", $_SERVER[HTTP_USER_AGENT]); }
	function is_mobile_windows() { return preg_match("/IEMobile/", $_SERVER[HTTP_USER_AGENT]); }
	function is_mobile_any()
	{
		return (is_mobile_android() || is_mobile_blackberry() || is_mobile_ios() || is_mobile_opera() || is_mobile_windows());
	}



	/**
	 * Curl-аналог file_get_contents
	 *
	 * @return {mixed} Контент страницы.
	 */
	function curl_get_contents($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_USERAGENT,
			'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
		);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}



	/**
	 * Возвращает безопасное для SQL-операций значение
	 *
	 * @param {mixed} vars Массив или строка для обработки.
	 * @param {boolean} assoc Вернуть массив или объект (если первым параметром был передан массив).
	 * @return {mixed} Безопасное для SQL-операций значение.
	 */
	function _valid($vars, $assoc = false)
	{
		if(is_array($vars))
		{
			$results = array();
			foreach($vars as $key => $var) $results[$key] = _valid($var);
			return json_decode(json_encode($results), $assoc);
		}
		else return addslashes(strip_tags(htmlspecialchars( $vars )));
	}



	/**
	 * Возвращает JSON-строку, пригодную для вставки в HTML-аттрибуты
	 *
	 * @param {mixed} var Массив, который следует перевести в JSON-формат.
	 * @return {string} JSON-строка.
	 */
	function _escape_json($var)
	{
		return htmlspecialchars(json_encode( $var ));
	}



	/**
	 * Модифицирует строку GET-параметров для URL, изменяя уже присутствующие значения и добавляя отсутствующие
	 *
	 * @param {string} key Ключ GET-переменной.
	 * @param {string} val Значение GET-переменной.
	 * @param {array} adt Если переданн массив, функция вернет обработку $adt, вместо обработки глобального массива GET.
	 * @return {mixed} Модифицированая строка GET-запроса.
	 */
	function _build_query_vars($key, $val, $adt = false)
	{
		$array = $adt && is_array($adt) ? $adt : $_GET;
		$array[ $key ] = $val;
		if( !$val ) unset( $array[ $key ] );
		return $adt && !is_array($adt) ? $array : http_build_query( $array );
	}



	/**
	 * Ассоциирует ключи со значениями взятыми из адреса запроса. /%page%/foo/bar/ => array( foo => bar )
	 *
	 * @return {array} Ассоциативный ассив.
	 */
	function _get_query_vars()
	{
		global $_QUERY;

		$out = array();
		$count = count($_QUERY);
		$count = $count % 2 == 0 ? $count : $count - 1;
		for( $i = 0; $i < $count; $i += 2 ) $out[ $_QUERY[$i] ] = $_QUERY[ $i + 1 ];

		return $out;
	}



	/**
	 * Выводит текстовую область с распечатаным массивом 
	 *
	 * @param {array} var Массив.
	 */
	function _debug($var)
	{
		print("<textarea style='height: 30em; width: 100%;'>");
		print_r( $var );
		print("</textarea>");
	}



	/**
	 * Выводит JSON-массив и завершает работу скрипта. Для ajax-функции
	 *
	 * @param {array} arr Массив.
	 */
	function _json($arr)
	{
		exit( json_encode( $arr ) );
	}



	/**
	 * Переадресовывает на указаный адрес методом JS. Ибо header() не работает, если что-либо уже было выведено в браузер
	 *
	 * @param {string} loc URL-адрес для переадресации.
	 */
	function _location($loc)
	{
		exit("<script> location.href='$loc'; </script>");
	}



	/**
	 * Генерирует супер-дупер-секретный хеш, на основе логина и пароля
	 *
	 * @param {string} login Логин.
	 * @param {string} pass Пароль.
	 * @return {string} Хеш-строка.
	 */
	function _passhash($login, $pass)
	{
		return md5($login) . sha1($pass) . md5($login);
	}



	/**
	 * Генерирует ключ-строку, используя латинский алфавит и цифры
	 *
	 * @param {number} len Длина ключ-строки
	 * @param {boolean} only_number Если true, ключ-строка будет содежать только цифры.
	 * @return {string} Ключ-строка.
	 */
	function _generate_key($len = 6, $only_number = false)
	{
		$arrSymbols = array('0','1','2','3','4','5','6','7','8','9');
		$arrLetters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

		if( !$only_number ) $arrSymbols = array_merge($arrSymbols, $arrLetters);

		$key = "";
		for($i = 0; $i < $len; $i++) $key .= $arrSymbols[rand(0,count($arrSymbols) - 1)];
		
		return $key;
	}



	/**
	 * Возвращает одно из трех переданых существительных, с правильным окончанием, в зависимости от кол-ва
	 *
	 * @param {string} one ([1-9]*)1 помидор
	 * @param {string} three ([1-9]*)2-4 помидора
	 * @param {string} many ([1-9]*)5-10 помидоров
	 * @param {number} count Число, характеризующее количество
	 * @return {string} Ключ-строка.
	 */
	function _suffix($one, $three, $many, $count)
	{
		return ( $count < 10 ? ($count == 1 ? $one : ($count > 1 & $count < 5 ? $three : $many ) ) : ($count > 10 && $count < 21 ? $many : ($count % 10 == 1 ? $one : ($count % 10 > 1 & $count % 10 < 5 ? $three : $many ) ) ) );
	}



	/**
	 * Переводит кириллицу в латиницу
	 *
	 * @param {string} str Кириллическая строка
	 * @return {string} Латинская строка.
	 */
	function _translit($str)
	{
	    $converter = array(
	        'а' => 'a',   'б' => 'b',   'в' => 'v',
	        'г' => 'g',   'д' => 'd',   'е' => 'e',
	        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
	        'и' => 'i',   'й' => 'y',   'к' => 'k',
	        'л' => 'l',   'м' => 'm',   'н' => 'n',
	        'о' => 'o',   'п' => 'p',   'р' => 'r',
	        'с' => 's',   'т' => 't',   'у' => 'u',
	        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
	        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
	        'ь' => '', 		'ы' => 'y',   'ъ' => '',
	        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
	        
	        'А' => 'A',   'Б' => 'B',   'В' => 'V',
	        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
	        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
	        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
	        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
	        'О' => 'O',   'П' => 'P',   'Р' => 'R',
	        'С' => 'S',   'Т' => 'T',   'У' => 'U',
	        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
	        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
	        'Ь' => '',  	'Ы' => 'Y',   'Ъ' => '',
	        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
	    );
	    
	    return strtr($string, $converter);
	}



	/**
	 * Конвертирует валюты, на основе данных ПриватБанка
	 *
	 * @param {string} ccy_from Валюта в формате USD, UAH...
	 * @param {string} ccy_to Валюта в формате USD, UAH...
	 * @param {string} amount Кол-во валюты ccy_from
	 * @return {number} Значение ccy_to относительно ccy_from.
	 */
	function _convert_ccy($ccy_from, $ccy_to, $amount)
	{
		if(isset($ccy_from, $ccy_to) && $ccy_from == $ccy_to)
			return $amount;
		
		$toUAH = array( "uah" => 1 );
		$exchangeRate = array();
		$backInTime = 259200;
		
		while(!count($exchangeRate))
		{
			$courses_data = json_decode(
				file_get_contents("https://api.privatbank.ua/p24api/exchange_rates?json&date=". date("d.m.Y", time() - $backInTime))
			);
			$exchangeRate = $courses_data->exchangeRate;
			$backInTime += 86400;
		}
		
		foreach($exchangeRate as $course) $toUAH[strtolower($course->currency)] = (float) $course->saleRateNB;
		
		$result = $amount * $toUAH[strtolower($ccy_from)];
		$result = $result / $toUAH[strtolower($ccy_to)];
		
		return round($result, 2);
	}



	/**
	 * Создает миниатюру изображения. Работает только с локальными ресурсами :(
	 *
	 * @param {string} src Расположение картинки
	 * @param {string} size Размер миниатюры (small, thumb, SIZExSIZE)
	 * @param {string} folder Рабочая папка
	 * @return {string} Путь к миниатюре.
	 */
	function _imaged($src, $size = 'full', $folder = "/assets/media/")
	{
		$r_src = $src;
		$imgfolder = substr($src, 0, 1) == "/" ? "" : $folder;

		if( substr($src, 0, 7) == "http://" || substr($src, 0, 8) == "https://" ) return $src;
		if( $imgfolder && substr($imgfolder, -1) != "/" ) $imgfolder = $imgfolder ."/";
		if( !file_exists(PATH . $imgfolder . $src) ) return $imgfolder . $src;

		if( $size != 'full' )
		{
			switch( $size )
			{
				case 'small': $sizes = array( 250, 'auto' ); break;
				case 'thumb': $sizes = array( 800, 'auto' ); break;
				default:
					if( substr_count($size, 'x') )
					{
						preg_match("/(.+)x(.+)/", $size, $matches);
						$sizes = array( $matches[1], $matches[2] );
					}
					else $sizes = false;
			}

			if( $sizes )
			{
				if( !file_exists( PATH . $imgfolder ) ) mkdir( PATH . $imgfolder );
				if( !file_exists( PATH . THUMBS_PATH ) ) mkdir( PATH . THUMBS_PATH );
				$ext = pathinfo(PATH . $imgfolder . $src, PATHINFO_EXTENSION);
				$r_src = str_replace(".". $ext, "", @end(explode('/', $src))) ."-". implode('x', $sizes) .".". $ext;
				$d_path = PATH . THUMBS_PATH . $r_src;

				if( !file_exists($d_path) )
				{
					$o_sizes = @getimagesize( PATH . $imgfolder . $src );
					$d_sizes = $o_sizes ? $o_sizes : array($sizes[0], $sizes[1]);

					if( $sizes[1] != 'auto' && $sizes[0] == 'auto' )
						$d_sizes[0] = $sizes[1] / $d_sizes[1] * $d_sizes[0];
					if( $sizes[0] != 'auto' && $sizes[1] == 'auto' )
						$d_sizes[1] = $sizes[0] / $d_sizes[0] * $d_sizes[1];
					if( $sizes[0] != 'auto' ) $d_sizes[0] = $sizes[0];
					if( $sizes[1] != 'auto' ) $d_sizes[1] = $sizes[1];

					if( $d_sizes[0] < $o_sizes[0] || $d_sizes[1] < $o_sizes[1] )
					{
						$o_image = file_get_contents( PATH . $imgfolder . $src );
						$o_image = imagecreatefromstring( $o_image );
						
						$d_image = imagecreatetruecolor( $d_sizes[0], $d_sizes[1] );
						imagecopyresized($d_image, $o_image, 0, 0, 0, 0, $d_sizes[0], $d_sizes[1], $o_sizes[0], $o_sizes[1]);

						switch($ext)
						{
							case 'jpg': case 'jpeg': imagejpeg($d_image, $d_path); break;
							case 'gif': imagegif($d_image, $d_path); break;
							case 'png': imagepng($d_image, $d_path); break;
						}

						imagedestroy( $o_image );
						imagedestroy( $d_image );
					}
					else $r_src = $src;
				}
				else $imgfolder = THUMBS_PATH;
			}
		}

		return str_replace("//", "/", WEBROOT . $imgfolder . $r_src);
	}



	/**
	 * Возвращает информацию о локации клиента по IP
	 *
	 * @param {string} ip IP-клиента
	 * @param {string} purpose Часть возвращаемой информации
	 * @param {boolean} deep_detect Глубокий анализ, поможет, если клиент использует бесплатный прокси
	 * @return {mixed} Путь к миниатюре.
	 */
	function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
	{
	    $output = NULL;
	    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE)
	    {
	        $ip = $_SERVER["REMOTE_ADDR"];
	        if ($deep_detect)
	        {
	            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

	            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	    }
	    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	    $continents = array(
	        "AF" => "Africa",
	        "AN" => "Antarctica",
	        "AS" => "Asia",
	        "EU" => "Europe",
	        "OC" => "Australia (Oceania)",
	        "NA" => "North America",
	        "SA" => "South America"
	    );
	    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support))
	    {
	        $ipdat = @json_decode(curl_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
	        if ( @strlen( trim($ipdat->geoplugin_countryCode) ) == 2 )
	        {
	            switch ($purpose)
	            {
	                case "location":
	                    $output = array(
	                        "city"           => @$ipdat->geoplugin_city,
	                        "state"          => @$ipdat->geoplugin_regionName,
	                        "country"        => @$ipdat->geoplugin_countryName,
	                        "country_code"   => @$ipdat->geoplugin_countryCode,
	                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
	                        "continent_code" => @$ipdat->geoplugin_continentCode
	                    );
	                    break;
	                case "address":
	                    $address = array($ipdat->geoplugin_countryName);
	                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
	                        $address[] = $ipdat->geoplugin_regionName;
	                    if (@strlen($ipdat->geoplugin_city) >= 1)
	                        $address[] = $ipdat->geoplugin_city;
	                    $output = implode(", ", array_reverse($address));
	                    break;
	                case "city":
	                    $output = @$ipdat->geoplugin_city;
	                    break;
	                case "state":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "region":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "country":
	                    $output = @$ipdat->geoplugin_countryName;
	                    break;
	                case "countrycode":
	                    $output = @$ipdat->geoplugin_countryCode;
	                    break;
	            }
	        }
	    }
	    
	    return (object) $output;
	}



	/**
	 * Сжимает HTML-код
	 *
	 * @param {string} buffer Не сжатый HTML-код.
	 * @return {mixed} Сжатый HTML-код.
	 */
	function html_compress($buffer)
	{
		if( mb_detect_encoding($buffer, 'UTF-8', true) ) $mod = '/u';
		else $mod = '/s';

		$buffer = str_replace(array (chr(13) . chr(10), chr(9)), array (chr(10), ''), $buffer);
		$buffer = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND'), $buffer);

		$split = explode('M1N1FY-3ND', $buffer); $buffer = '';
		for ($i=0; $i<count($split); $i++)
		{
			$ii = strpos($split[$i], 'M1N1FY-ST4RT');

			if( $ii !== false )
			{
				$process = substr($split[$i], 0, $ii);
				$asis = substr($split[$i], $ii + 12);

				if( substr($asis, 0, 7) == '<script' )
				{
					$split2 = explode(chr(10), $asis); $asis = '';
					for($iii = 0; $iii < count($split2); $iii ++)
					{
						if( $split2[$iii] ) $asis .= trim($split2[$iii]) . chr(10);
						if( strpos($split2[$iii], '//') !== false && substr(trim($split2[$iii]), -1) == ';' ) $asis .= chr(10);
					}

					if ($asis) $asis = substr($asis, 0, -1);
					$asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
					$asis = str_replace(array (';' . chr(10), '>' . chr(10), '{' . chr(10), '}' . chr(10), ',' . chr(10)), array(';', '>', '{', '}', ','), $asis);
				}
				elseif( substr($asis, 0, 6) == '<style' )
				{
					$asis = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $asis);
					$asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
					$asis = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}'), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ',', '}'), $asis);
				}
			}
			else
			{
				$process = $split[$i];
				$asis = '';
			}

			$process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $process);
			$process = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->' . $mod, '', $process);
			$buffer .= $process.$asis;
		}

		$buffer = str_replace(array (chr(10) . '<script', chr(10) . '<style', '*/' . chr(10), 'M1N1FY-ST4RT'), array('<script', '<style', '*/', ''), $buffer);
		if ( strtolower( substr( ltrim( $buffer ), 0, 15 ) ) == '<!doctype html>' ) $buffer = str_replace( ' />', '>', $buffer );

		return $buffer;
	}
?>