<?php

class TwDonorLinkController extends FrontController{

	public $costumer_key = 'gSD6pWs1zZnJPHRHFvYVTg';
	public $costumer_secret = 't4Y64ig7pPcRUQKP0jMUEpJWeVF5K6XzDwg6GeHZQ';
	public $access_token = '702736716-f4ifmBjUQLU1IyUOPzDGUdPCsah89LVpZrOix50G';
	public $access_token_secret = 'Nfr8XZtFJcKKCYxZfSzEhtewp4M2axwxSn3fvNt2x0';

	public function actionIndex($token=null){

		// d();

		if($token !== 'token'){
			Yii::app()->end();
		}

		$str = $this->getStr();


		// соединяемся с сервером твиттера 
		$twitter = new TwitterOAuth( 
			$this->costumer_key,
			$this->costumer_secret,
			$this->access_token,
			$this->access_token_secret
		);
		$twitter->host = 'https://api.twitter.com/1.1/';

		$twitter->post( 'statuses/update', array( 'status' => $this->normalDate(time()) . ' ' .  $str['url'] ) );

		

		Yii::app()->end();
	}

	private function getStr(){
		$time=time()-(7*24*60*60);
		$str =array();
		$criteria = new CDbCriteria;
		// $criteria->condition='tw_public_time<'.$time;
		$criteria->addCondition('check_link=1');
		$criteria->order='tw_public_time ASC';

		$link = Link::model()->find($criteria);
		$link->tw_public_time = time();
		$link->update();
		$str['url']=$link->from_url;

		$page = $this->curl($link->from_url);

		file_put_contents(Yii::app()->basePath.'/runtime/tmp_page.txt', $page);
		$meta = get_meta_tags(Yii::app()->basePath.'/runtime/tmp_page.txt');
		$str['description'] = isset($meta['description'])? $meta['description'] : '' ;
		return $str;
	}

	protected function curl($url){
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		// curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30);
		return curl_exec($curl);
	}

	
	private function normalDate($date){
	    $month=array(
	    'January'=>"Січня",'February'=>"Лютого",'March'=>"Березня",
	    'April'=>"Квітня",'May'=>"Травня",'June'=>"Червня",
	    'July'=>"Липня",'August'=>"Серпня",'September'=>"Вересня",
	    'October'=>"Жовтня",'November'=>"Листопада",'December'=>"Грудня");

	    $a=$month[date("F", $date)];
	    $b=date("j",$date);
	    $c=date("Y", $date);
	    $t = date('H:i', $date);
	    return $b.' '.$a." ".$c.' року о '.$t;
	}

}





