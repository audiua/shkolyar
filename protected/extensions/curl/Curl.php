<?php

class Curl
{
	private $_referer;
	private $_cookie;
	private $_headers;
	private $_userAgent;


	public function get( $url ){
		$page=array();
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,30);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);

		if( $this->getReferer() ){
			curl_setopt($ch, CURLOPT_REFERER, $this->_referer);
		}
		
		if($this->getCookie() ){
			curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookie);  
			curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookie);
		}

		if($this->getUserAgent() ){
			curl_setopt($ch, CURLOPT_USERAGENT, $this->_userAgent);
		}
		
		// if($this->headers)
		// {
		// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		// }


		// curl_setopt($ch, CURLOPT_STDERR,  fopen('php://output', 'w'));
		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$page['headers']= explode("\r\n", substr($response, 0, $header_size) );
		$page['body'] = substr($response, $header_size);

		$page['error'] = curl_error($ch);
		curl_close($ch);

		return $page;
	}

	private function getCookie(){
		if(! $this->_cookie){
			$this->_cookie = dirname(__FILE__).'/cookie.txt';
			if(!file_exists($this->_cookie)){
				touch($this->_cookie, 0777);
			}
		}

		return $this->_cookie;
	}

	private function getUserAgent(){
		if(!$this->_userAgent){
			if(file_exists(dirname(__FILE__).'/userAgent.php')){
				$all = include( dirname(__FILE__).'/userAgent.php' );
				if($all){
					$this->_userAgent = $all[array_rand($all,1)];
				}
			} else {
				$this->_userAgent='Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)';
			}
		}
		
		return $this->_userAgent;
		
	}

	private function getHeaders(){
		return null;
	}

	private function getReferer(){

		if(! $this->_referer){
			if(file_exists(dirname(__FILE__).'/referer.php')){
				$all = include( dirname(__FILE__).'/referer.php' );
				if($all){
					$this->_referer = $all[array_rand($all,1)];
				}
			} else {
				$this->_referer = 'http://google.com.ua';
			}
		}

		return true;
	}
}