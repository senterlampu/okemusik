<!--<?php

/* PopAds simple adcode fetching library, second revision
 * Compatible with PHP4-7
 *
 * Usage:
 * in your template, between <head> and </head>, insert:
 * <?php include('<path-to-this-file>/popads.php'); ?>
 *
 * Warning: it won't work with template systems like Smarty as-is! To make it working:
 * - remove <!-- from the beginning and $pa_orep = error_reporting(0); phrase
 * - remove everything from the /* 8<---- comment at the end onwards
 * - change var $verbose = true; to var $verbose = false;
 * - include this file, create new PopAdsAdcode() object and get the adcode via read() method, then bind it to template
 * Don't use get_* methods directly without caching on your side.
 *
 */

$pa_orep = error_reporting(0);

class PopAdsAdcode {

	/* Same as in Code Generator */
	var $minBid = 0;
	var $popundersPerIP = 0;
	var $delayBetween = 0;
	var $defaultPerDay = 0;
	var $topmostLayer = 0;
	/* URL or Base64-encoded Javascript */
	var $default = false;
	/* Your individually-assigned settings */
	var $key = '2e038a6b389e22a5579f45f09cfd613269d3716a';
	var $siteId = 1568608;
	/* It's better to leave below as-is, really */
	var $antiAdblock = 1;
	var $obfuscate = 1;

	/* Set to true, if your server properly supports SSL (OpenSSL or equiv. installed, and IPv6 resolving disabled -
	   it is known to cause problems while trying to resolve our domain on certain configurations) */
	var $ssl = false;
	/* Set to false to suppress outputting debug information */
	var $verbose = true;
	/* Set to override adcode cache directory */
	var $adcodeDir = false;

	function get_curl($url) {
		/* Test capabilities */
		if ((!extension_loaded('curl')) || (!function_exists('curl_version')))
			return false; /* cURL does not exist */
		/* Initialize object */
		curl_setopt_array($curl = curl_init(), array(
			CURLOPT_RETURNTRANSFER => 1,			CURLOPT_USERAGENT => 'PopAds CGAPIL A',
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,	CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_SSL_VERIFYPEER => true,			CURLOPT_HEADER => false,
			CURLOPT_HTTPHEADER => array('Accept: text/plain,application/json;q=0.9')
		));
		/* Test capabilities for HTTPS */
		if ($this->ssl && (($version = curl_version()) && ($version['features'] & CURL_VERSION_SSL))) {
			curl_setopt($curl, CURLOPT_URL, 'https://www.popads.net' . $url);
			if ($code = curl_exec($curl)) {
				curl_close($curl);
				return $code;
			}
		}
		/* Proceed via HTTP */
		curl_setopt($curl, CURLOPT_URL, 'http://www.popads.net' . $url);
		$code = curl_exec($curl);
		curl_close($curl);
		return $code; /* False on failure */
	}

	/* Not recommended; does not send Accept header, no control over SSL peer verification, might try to resolve IPV6 */
	function get_fgc($url) {
		/* Test capabilities */
		if ( (!function_exists('file_get_contents')) || (!ini_get('allow_url_fopen')) || ((function_exists('stream_get_wrappers')) && (!in_array('http', stream_get_wrappers()))) )
			return false; /* file_get_contents does not exist or does not support URL retrieval at all */
		/* Test capabilities for HTTPS (PHP5+) */
		if ($this->ssl && ((!function_exists('stream_get_wrappers')) || (in_array('https', stream_get_wrappers())))) {
			$code = file_get_contents('https://www.popads.net' . $url);
			if ($code)
				return $code;
		}
		/* Proceed via HTTP */
		return file_get_contents('http://www.popads.net' . $url); /* False on failure */
	}

	/* Not recommended; no control over SSL peer verification, might try to resolve IPV6 if using HTTPS */
	function get_fsock($url) {
		$enum = $estr = $in = $out = '';
		/* Test capabilities */
		if ($this->ssl && ((!function_exists('stream_get_wrappers')) || (in_array('https', stream_get_wrappers())))) {
			$fp = fsockopen('ssl://' . 'www.popads.net', 443, $enum, $estr, 10);
		}
		/* Initialize plain connection */
		if ((!$fp) && (!($fp = fsockopen('tcp://' . gethostbyname('www.popads.net'), 80, $enum, $estr, 10))))
			return false;
		$out .= "GET " . $url . " HTTP/1.1\r\n";
		$out .= "Host: www.popads.net\r\n";
		$out .= "User-Agent: PopAds CGAPIL C\r\n";
		$out .= "Accept: text/plain,application/json;q=0.9\r\n";
		$out .= "Connection: close\r\n\r\n";
		fwrite($fp, $out);
		while (!feof($fp)) {
			$in .= fgets($fp, 1024);
		}
		fclose($fp);
		return substr($in, strpos($in, "\r\n\r\n") + 4);
	}

	/* Not recommended; no SSL support at all */
	function get_sock($url) {
		$in = $out = '';
		/* Only HTTP, last resort */
		if (!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
			return false;
		socket_set_block($sock);
		if (!socket_connect($sock, gethostbyname('www.popads.net'), 80))
			return false;
		$out .= "GET " . $url . " HTTP/1.1\r\n";
		$out .= "Host: www.popads.net\r\n";
		$out .= "User-Agent: PopAds CGAPIL D\r\n";
		$out .= "Accept: text/plain,application/json;q=0.9\r\n";
		$out .= "Connection: close\r\n\r\n";
		socket_send($sock, $out, strlen($out), MSG_EOF);
		$in = socket_read($sock, 32768);
		socket_close($sock);
		return empty($in) ? false : substr($in, strpos($in, "\r\n\r\n") + 4);
	}

	function tmp_dir() {
		$paths = array_unique(array_filter(array(
			'usr' => $this->adcodeDir,
			'ssp' => realpath(session_save_path()),
			'utd' => realpath(ini_get('upload_tmp_dir')),
			'env1' => (!empty($_ENV['TMP'])) ? realpath($_ENV['TMP']) : false,
			'env2' => (!empty($_ENV['TEMP'])) ? realpath($_ENV['TEMP']) : false,
			'env3' => (!empty($_ENV['TMPDIR'])) ? realpath($_ENV['TMPDIR']) : false,
			'sgtd' => (function_exists('sys_get_temp_dir')) ? realpath(sys_get_temp_dir()) : false,
			'cwd' => realpath(getcwd()),
			'cfd' => realpath(dirname(__FILE__))
		)));
		foreach ($paths as $key => $path) {
			if (($name = tempnam($path, 'popads-')) && (file_exists($name))) {
				unlink($name);
				if (strcasecmp(realpath(dirname($name)), $path) == 0) {
					if ($this->verbose) print 'T' . $key;
					return $path;
				}
			}
		}
		if ($this->verbose) print 'Terr';
		return false;
	}

	function build_query($query) {
		if ((function_exists('http_build_query')) && ($line = http_build_query($query, '', '&', PHP_QUERY_RFC3986))) {
			return $line;
		}
		/* Especially for PHP4 */
		$line = '';
		foreach ($query as $k => $v) {
			$line .= ((strlen($line) > 0) ? '&' : '') . rawurlencode($k) . '=' . rawurlencode($v);
		}
		return $line;
	}

	function format_url() {
		$uri = '/api/website_code?';
		$uric = array(
			'key' => $this->key,
			'website_id' => $this->siteId
		);
		if ($this->minBid > 0)
			$uric['mb'] = $this->minBid;
		if ($this->popundersPerIP > 0)
			$uric['ppip'] = $this->popundersPerIP;
		if ($this->delayBetween > 0)
			$uric['db'] = $this->delayBetween;
		if ($this->defaultPerDay > 0)
			$uric['dpd'] = $this->defaultPerDay;
		if ($this->topmostLayer > 0)
			$uric['tl'] = $this->topmostLayer;
		if ($this->antiAdblock) {
			$uric['aab'] = 1;
			$uric['of'] = 1;
		} else {
			if ($this->obfuscate)
				$uric['of'] = intval($this->obfuscate);
		}
		if (($this->default) && ($decoded_def = ($this->default)))
			$uric['def'] = $decoded_def;
		return $uri . $this->build_query($uric);
	}

	/* Verbose version for debugging purposes */
	function read() {
		if ($this->verbose) print ' ';
		$url = $this->format_url();
		$tmp_dir = $this->tmp_dir();
		if (!$tmp_dir)
			return '';
		$fn = $tmp_dir . '/popads-' . md5($url) . '.js';
		/* If exists and not older than a day, return */
		if (file_exists($fn) && (time() - filemtime($fn) < 3600))
			return file_get_contents($fn);
		if (file_exists($fn . '.lock') && (time() - filemtime($fn . '.lock') < 60))
			{ if ($this->verbose) print 'L'; return ''; }
		print 'A'; $code = $this->get_curl($url);
		if (!$code) { if ($this->verbose) print 'B'; $code = $this->get_fgc($url); }
		if (!$code) { if ($this->verbose) print 'C'; $code = $this->get_fsock($url); }
		if (!$code) { if ($this->verbose) print 'D'; $code = $this->get_sock($url); }
		if (!$code) { if ($this->verbose) print 'E'; $code = ''; }
		if ((!empty($code)) && (strpos($code, '<!-- PopAds.net') !== false)) {
			file_put_contents($fn, $code);
			chmod($fn, 0755);
			clearstatcache(true, $fn);
			return $code;
		} else {
			file_put_contents($fn . '.lock', $code);
			chmod($fn . '.lock', 0755);
			return '';
		}
	}

}

/* 8<---- */

$pad = new PopAdsAdcode();
$pad_code = $pad->read();

error_reporting($pa_orep);

?>-->
<?php print $pad_code; ?>
