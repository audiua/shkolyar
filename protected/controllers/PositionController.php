<?php

class PositionController extends Controller{

	const TOKEN = 'token';
	const PERIOD = 25200;
	private $googleUrl = 'https://www.google.com.ua/search?hl=ru&num=50&btnG=%D0%9F%D0%BE%D0%B8%D1%81%D0%BA%2B%D0%B2%2BGoogle&as_epq=&as_oq=&as_eq=&lr=&cr=&as_ft=i&as_filetype=&as_qdr=all&as_occt=any&as_dt=i&as_sitesearch=&as_rights=&safe=images&gws_rd=ssl';

	private $keyword;
	private $host = 'shkolyar.info';
	private $maxPosition = 100;

	public function actionIndex($token){
		if($token !== self::TOKEN){
			Yii::app()->end();
		}

		$this->keyword = $this->nextKeyword();


		// print_r($this->keyword);
		// die;


		if($this->checkKeyword()){
			Yii::app()->end();
		}
		
		$newPosition = new KeywordPosition;

		// $newPosition->google_position = $this->google();
		// $newPosition->yandex_position = $this->yandex();
		// $newPosition->keyword_id = $this->keyword->id;
		// $newPosition->create_time = time();

		$newPosition->google_position = mt_rand(1,100);
		$newPosition->yandex_position = mt_rand(1,100);
		$newPosition->keyword_id = $this->keyword->id;
		$newPosition->create_time = time();
		

		// print_r($newPosition);
		// die;


		$newPosition->save();

	}

	protected function google(){
		$url = $this->googleUrl .'&as_q='.urlencode ($this->keyword->keyword);
		$start = 0;

		while($start <= 1){

			$url .= '&start='.$start;


			// echo $url;
			// die;
			
			// $googleResult = file_get_contents($url);


			$googleResult = file_get_contents('filename');

			if(!$googleResult){
				$googleResult = $this->curl($url);
			}

			if(!$googleResult){
				return null;
			}

			if(preg_match_all('/<h3 class="r"><a href="(.+?)"/is', $googleResult, $match)){

				foreach($match[1] as $i => $item){
					if(stripos($item, $this->host) !== false){
						return $i+1;
					}
				}

	        }

	        $start++;
	        sleep(3);
		}

		return 0;

	}

	protected function yandex(){
		return 0;
	}

	protected function nextKeyword(){
		$criteria = new CDbCriteria;
		$criteria->order = 'update_time ASC';
		$keyword = Keyword::model()->find($criteria);
		$keyword->update_time = time();
		$keyword->update();

		return $keyword;
	}

	protected function checkKeyword(){
		$criteria = new CDbCriteria;
		$criteria->condition = 'keyword_id='.$this->keyword->id;
		// $criteria->addCondition('create_time>'.time()-self::PERIOD);
		$criteria->addCondition('create_time>'.time());
		$checkPosition = KeywordPosition::model()->find($criteria);

		if($checkPosition){
			return true;
		}

		return false;
	}

	protected function curl($url){
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30);
		return curl_exec($curl);
	}




}
