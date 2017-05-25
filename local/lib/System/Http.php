<?
namespace Local\System;

class Http
{
	private $timeout = 20;
	private $cookieFile = '';
	private $userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0';
	private $header = [
		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
		'Cache-Control: max-age=0',
		'Connection: keep-alive',
	];
	private $info = [];

	public function __construct($options = [])
	{
		foreach ($options as $k => $v)
		{
			if ($k == 'cookie')
				$this->cookieFile = $_SERVER['DOCUMENT_ROOT'] . $v;
			elseif ($k == 'userAgent')
				$this->userAgent = $v;
			elseif ($k == 'timeout')
				$this->timeout = $v;
		}
	}

	public function get($url)
	{
		return $this->send($url);
	}

	public function post($url, $post, $headers = [])
	{
		return $this->send($url, $post, $headers);
	}

	private function send($url, $post = '', $headers = [])
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if (!$headers)
			$headers = $this->header;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($post)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		if ($this->cookieFile)
		{
			curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);
		}
		$result = curl_exec($ch);
		$this->info = curl_getinfo($ch);
		curl_close($ch);

		return $result;
	}

	public function getUserAgent()
	{
		return $this->userAgent;
	}

	public function getHeaders()
	{
		return $this->header;
	}

}
