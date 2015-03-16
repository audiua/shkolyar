<?php

class CurlHelper
{

	private $_cookieFile='cookie.txt';

	public function connect( $url, array $param=array() )
	{
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,20);
		// curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);

		$referer = $this->getReferer();
		if($referer)
		{
			curl_setopt($curl, CURLOPT_REFERER, $referer);
		}
		
		$cookie = $this->getCookie();
		if($cookie)
		{
			curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);  
			curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
		}

		$headers = $this->getHeaders();
		if($headers)
		{
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}
		
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);

		$page = curl_exec($curl);

		$error = curl_error($curl);
		curl_close($curl);
		// d($page);
		d($page);


		return $page;
	}

	private function getCookie()
	{
		$cookie = dirname(__FILE__).'/cookie.txt';
		if(!file_exists($cookie))
		{
			touch($cookie, 777);
		}
		
		return $cookie;
	}

	private function getUserAgent()
	{
		$agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)';
		$all = include( dirname(__FILE__).'/userAgent.php' );
		if($all)
		{
			$agent = $all[array_rand($all,1)];
		}
		
		return $agent;
		
	}

	private function getHeaders()
	{
		return null;
	}

	private function getReferer()
	{
		$referer = 'http://google.com.ua';
		$all = include( dirname(__FILE__).'/referer.php' );
		if($all)
		{
			$referer = $all[array_rand($all,1)];
		}

		return $referer;
	}
}