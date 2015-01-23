<?php

class VkController extends Controller{

	const CLIENT_ID = '4745114';
	const ACCESS_TOKEN = '5b378f79854d54f466309da9ccf2183fe1722e390639e503fcd615efd91b5a2bd7b0d76ed60fd2add21b0';

	public function actionIndex($hash=null){

		if($hash !== '5b717f9e843de36448780e90f00942fc'){
			Yii::app()->end();
		}




		$gdz = $this->getGdz();
		if($gdz){
			$str = $gdz->gdz_clas->clas->slug . ' клас ' . $gdz->gdz_subject->subject->title . ' ' . $gdz->author  . ' ' . Yii::app()->createAbsoluteUrl( $gdz->getUrl() );
				
				echo $str;
				die;

				$this->invoke('wall.post', array(
				    'owner_id' => -81422422,
				    'message' => $str,
				    'from_group' => 1
				));
		}




		Yii::app()->end();
	}

	private function invoke($name, array $params = array()){
		$params['access_token'] = self::ACCESS_TOKEN;
		$content = file_get_contents('https://api.vkontakte.ru/method/'.$name.'?'.http_build_query($params));
		$result = json_decode($content);
		print_r($result);
	}

	private function auth(array $scopes){
		header('Content-type: text/html; charset=utf-8');
		echo file_get_contents('http://oauth.vkontakte.ru/authorize?'.http_build_query(
			array(
				'client_id' => self::CLIENT_ID,
				'scope' => implode(',', $scopes),
				'redirect_uri' => 'http://api.vkontakte.ru/blank.html',
				'display' => 'page',
				'response_type' => 'token'
			)
		));
	}

	private function getGdz(){

		$lastTime = VkTimePosting::model()->findByPk(1);

		$criteria = new CDbCriteria;
		$criteria->condition = 'public=1';
		$criteria->addCondition('public_time > '.$lastTime->gdz_last_public_time);
		$criteria->addCondition('public_time < '.time());
		$gdz = GdzBook::model()->find($criteria);
		if($gdz){
			$lastTime->gdz_last_public_time = strtotime($gdz->public_time);
			$lastTime->update();
		}
		
		return $gdz;
	}

	private function getTextbook(){
		$gdz = GdzBook::model()->public()->find();
		print_r($gdz);
		die;
	}

	private function getWriting(){
		$gdz = GdzBook::model()->public()->find();
		print_r($gdz);
		die;
	}

	private function getLibrary(){
		$gdz = GdzBook::model()->public()->find();
		print_r($gdz);
		die;
	}

	private function getAuthor(){
		$gdz = GdzBook::model()->public()->find();
		print_r($gdz);
		die;
	}

	private function getKnowall(){
		$gdz = GdzBook::model()->public()->find();
		print_r($gdz);
		die;
	}
}





