<?php
include_once('Sape.php');
class SapeController extends FrontController{

	const TOKEN = 'token';
	const PERIOD = 25200;
	const SAPE_PROJECT_ID = '2328413';
	const SAPE_LOGIN='rompetrom';
	const SAPE_PASSWORD='zxcvbnm123456789';
	public $host = 'http://shkolyar.info';

	private $_sape;

	public function init(){
		$this->_sape = new SapeClient(self::SAPE_LOGIN, self::SAPE_PASSWORD, 'cookie');
	}

	public function beforeAction($action){
		$token = Yii::app()->request->getParam('token', null);
		if($token !== self::TOKEN){
			Yii::app()->end();
		}

		return parent::beforeAction($action);
	}

	public function actionIndex(){
		d( $links = $this->_sape->get_url_links(85729506) );
	}


	// урлы проекта сапы прикрепляем к ключевым словам
	public function actionSapeUrlToKeyword(){
		$projectUrls = $this->_sape->get_urls(self::SAPE_PROJECT_ID);
		
		// sape url id
		foreach( $projectUrls as $url ){
			$keyword = Keyword::model()->findByAttributes(array('keyword'=>$url['name'], 'sape_url_id'=>0));
			if($keyword){
				$keyword->sape_url_id = $url['id'];
				$keyword->update();
			}
		}


		Yii::app()->end();
	}

	// ссылки с сапы для всех урлов проекта
	public function actionKeywordLink(){

		$criteria = new CDbCriteria;
		$criteria->condition = 't.sape_url_id > 0';
		$criteria->order = 't.sape_get_links_time ASC';

		$keyword = Keyword::model()->find($criteria);
		if(! $keyword ){
			Yii::app()->end();
		}

		$links = $this->_sape->get_url_links($keyword->sape_url_id);
		$keyword->sape_get_links_time = time();
		$keyword->update();
		if(! $links ){
			Yii::app()->end();
		}

		foreach( $links as $link ){

			$criteria = new CDbCriteria;
			$criteria->condition = 't.sape_link_id='.$link['id'];
			$LinkModel = Link::model()->find($criteria);
			if(! $LinkModel){
				$LinkModel = new Link;
				$LinkModel->from_url = $link['site_url'].$link['page_uri'] ;
				$LinkModel->on_url = $this->host . $keyword->url ;
				$LinkModel->keyword_id = $keyword->id ;
				$LinkModel->ankor = $link['txt'] ;
				$LinkModel->links_on_donor = $link['page_nof_ext_links'] ;
				$LinkModel->sape_link_id = $link['id'] ;
				$LinkModel->link_source = 'sape' ;
				$LinkModel->save() ;
			}
		}
	}

	/**
	 * actionCheckSapeLink проверка ссылки в статусе ок и ее существования в сапе
	 * @return [type] [description]
	 */
	public function actionCheckSapeLink(){
		
		$criteria = new CDbCriteria;
		$criteria->order = 'check_time ASC';
		$link = Link::model()->find($criteria);
		if( ! $link){
			Yii::app()->end();
		}

		// проверка ссылки на сайте донора
		$checkLink = $this->checkLink($link);

		// ссылки урла на сапе
		$links = $this->_sape->get_url_links($link->keyword->sape_url_id);

		// если в базе ссылка есть, а в сапе нет - на удаление
		$flag=false;
		foreach($links as $item){
			if($link->sape_link_id == $item['id']){
				$flag=true;
			}
		}

		// удаляем если нет в сапе и на доноре нет ссылки
		if( ! $flag && ! $checkLink ){
			$link->delete();
		}

		$link->check_link = $checkLink;
		$link->check_time = time();
		$link->update();

	}


	
	/**
	 * checkLink проверка ссылки на странице донора
	 * @return [type] [description]
	 */
	private function checkLink($link){
		// $page = file_get_contents($link->from_url);
		// if(! $page){
		// }
		$page = $this->curl($link->from_url);

		if( ! $page){
			return false;
		}

		echo $link->on_url;
		echo '   ';
		echo $link->from_url;

		return ( stripos($page, $link->on_url) !== false );
	}


	protected function curl($url){
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		// curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30);
		return curl_exec($curl);
	}




}