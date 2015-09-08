<?php

class VkDonorLinkController extends FrontController{

	const CLIENT_ID = '4819475';
	const ACCESS_TOKEN = 'c14334e3d45fa0d27d3d16a716093b0b463bb1f46849f4d36a65303cb6ebd6da0b814b004dd5dd466e02f';
	const OWNER_ID = 89242065;
	public $host= 'http://shkolyar.info';


	public function actionIndex($token=null){

		if($token !== 'token'){
			Yii::app()->end();
		}

		$str = $this->getStr();
		if(!$str){
			Yii::app()->end();
		}

		$vk = new vk(self::ACCESS_TOKEN, 100, self::CLIENT_ID, self::OWNER_ID);
		
		$vk->post($str['description'], '', $str['url'] );

		// 	$this->invoke('wall.post', array(
		// 	    'owner_id' => -81422422,
		// 	    'message' => $str,
		// 	    'from_group' => 1
		// 	));
		// }

		Yii::app()->end();
	}

	private function invoke($name, array $params = array()){
		$params['access_token'] = self::ACCESS_TOKEN;
		$content = file_get_contents('https://api.vkontakte.ru/method/'.$name.'?'.http_build_query($params));
		$result = json_decode($content);
		print_r($result);
	}


	private function getStr(){
		$time=time()-(7*24*60*60);
		$str =array();
		$criteria = new CDbCriteria;
		$criteria->condition='vk_public_time<'.$time;
		$criteria->addCondition('check_link=1');
		$criteria->order='vk_public_time ASC';

		$link = Link::model()->find($criteria);
		if(!$link){
			return false;
		}
		$link->vk_public_time = time();
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





