<?php

class VkController extends Controller{

	const CLIENT_ID = '4745114';
	const ACCESS_TOKEN = '5b378f79854d54f466309da9ccf2183fe1722e390639e503fcd615efd91b5a2bd7b0d76ed60fd2add21b0';
	const OWNER_ID = 81422422;

	// альбомы
	public $gdz_album = '211693147';
	public $textbook_album = '211693182';
	public $writing_album = '211693260';
	public $library_album = '211693239';
	public $knowall_album = '211693279';

	// $default_album = '206468671';


	

	// флаг что есть публ
	private $_p=false;

	public function actionIndex($hash=null, $mode=null){

		


		if($hash !== '5b717f9e843de36448780e90f00942fc'){
			Yii::app()->end();
		}

		$method = 'get'.ucfirst($mode);
		$model = $this->$method();

		// d($model);

		if($model){

			$vk = new vk(self::ACCESS_TOKEN, 100, self::CLIENT_ID, 81422422);

			$str = '';
			switch($mode){
				case 'gdz': 

				if($this->_p){
					$str .= $this->normalDate(time()).' обновлено збірник готових домашніх завдань ';
				} else {
					$str .= $this->normalDate(strtotime($model->public_time)).' добавлено новий збірник готових домашніх завдань ';
				}

				// $path = 'img/gdz/'.$model->gdz_clas->clas->slug.'/'.$model->gdz_subject->subject->slug.'/'.$model->slug.'/book';
				// $file = Yii::app()->basePath . '/' . $path.'/'.$model->slug.'.'.$model->img;

				// $vk = new VkApi(self::CLIENT_ID, self::ACCESS_TOKEN, $file);
				
				if(!$model->vk_img){
					$path = 'img/gdz/'.$model->gdz_clas->clas->slug.'/'.$model->gdz_subject->subject->slug.'/'.$model->slug.'/book';
					$file = Yii::app()->basePath . '/../' . $path.'/'.$model->slug.'.'.$model->img;
					// d($file);


					$model->vk_img = $vk->upload_photo( $file, $this->gdz_album, 'гдз '.$model->title.' '.$model->author.' '.$model->gdz_clas->clas->slug.' клас', $model->slug.'.'.$model->img, $model->img );
					$model->update();
				}	

				$str .= $model->gdz_clas->clas->slug . ' клас ' . $model->gdz_subject->subject->title . ' ' . $model->author  . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				break;

				case 'textbook': 

				if($this->_p){
					$str .= $this->normalDate(time()).' обновлено підручник ';
				} else {
					$str .= $this->normalDate(strtotime($model->public_time)).' добавлено новий підручник ';
				}

				$str .= $model->textbook_clas->clas->slug . ' клас ' . $model->textbook_subject->subject->title . ' ' . $model->author  . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				break;

				case 'writing': 

				if($this->_p){
					$str = $this->normalDate(strtotime($model->public_time)).' обновлено шкільний твір по предмету '.$model->subject->title .' для ' . $model->clas->slug . ' класу на тему: '. $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				} else {
					$str = $this->normalDate(strtotime($model->public_time)).' добавлено новий шкільний твір по предмету '.$model->subject->title .' для ' . $model->clas->slug . ' класу на тему: '. $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				}

				break;

				case 'library': 

					if($this->_p){
						$str = $this->normalDate(strtotime($model->public_time)).' обновлено твір художньої літератури '.$model->library_author->author . ' ' . $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					} else {
						$str = $this->normalDate(strtotime($model->public_time)).' добавлено новий твір художньої літератури '.$model->library_author->author .' ' . $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					}

				break;

				case 'author': 

					if($this->_p){
						$str = $this->normalDate(strtotime($model->public_time)).' обновлено данні автора '.$model->author.' у розділі художня література - ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					} else {
						$str = $this->normalDate(strtotime($model->public_time)).' добавлений новий автор '.$model->author.' з біографією та творами у розділ художня література '. Yii::app()->createAbsoluteUrl( $model->getUrl() );
					}

				break;

				case 'knowall': 

					if($this->_p){
						$str = $this->normalDate(strtotime($model->public_time)).' обновленно статтю у розділі Всезнайка '.$model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					} else {
						$str = $this->normalDate(strtotime($model->public_time)).' добавлено нову цікаву статтю у розділ Всезнайка '.$model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					}

				break;

			}

			$vk->post($str, $model->vk_img, Yii::app()->createAbsoluteUrl( $model->getUrl()) );

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
		$time = time() - 14400;

		if($lastTime->gdz_last_public_time < $time){

			$criteria = new CDbCriteria;
			$criteria->condition = 'public=1';
			$criteria->addBetweenCondition('public_time', $lastTime->gdz_last_public_time+1, $time);
			$criteria->order = 'public_time ASC';
			$gdz = GdzBook::model()->find($criteria);
			if($gdz){
				$lastTime->gdz_last_public_time = strtotime($gdz->public_time);
				if( ! $lastTime->update()){
					die($lastTime->gerErrors);
				}

				$public = VkPosting::model()->findbyAttributes(array('owner'=>'gdz', 'owner_id'=>$gdz->id));
				if($public){
					$public->update();
					$this->_p = true;
				} else {
					$public = new VkPosting;
					$public->owner = 'gdz';
					$public->owner_id = $gdz->id;
					$public->save();
				}
			}
			
			return $gdz;
		}

		return null;

	}

	private function getTextbook(){
		$lastTime = VkTimePosting::model()->findByPk(1);
		$time = time() - 14400;

		if($lastTime->textbook_last_public_time < $time){

			$criteria = new CDbCriteria;
			$criteria->condition = 'public=1';
			$criteria->addBetweenCondition('public_time', $lastTime->textbook_last_public_time+1, $time);
			$criteria->order = 'public_time ASC';
			$textbook = TextbookBook::model()->find($criteria);
			if($textbook){
				$lastTime->textbook_last_public_time = strtotime($textbook->public_time);
				$lastTime->update();

				$public = VkPosting::model()->findbyAttributes(array('owner'=>'textbook', 'owner_id'=>$textbook->id));
				if($public){
					$public->update();
					$this->_p = true;
				} else {
					$public = new VkPosting;
					$public->owner = 'textbook';
					$public->owner_id = $textbook->id;
					$public->save();
				}
			}
			
			return $textbook;
		}

		return null;
	}

	private function getWriting(){
		$lastTime = VkTimePosting::model()->findByPk(1);
		$time = time() - 14400;

		if($lastTime->writing_last_public_time < $time){

			$criteria = new CDbCriteria;
			$criteria->condition = 'public=1';
			$criteria->addBetweenCondition('public_time', $lastTime->writing_last_public_time+1, $time);
			$criteria->order = 'public_time ASC';

			$writing = Writing::model()->public()->find($criteria);
			if($writing){
				$lastTime->writing_last_public_time = strtotime( $writing->public_time );
				$lastTime->update();

				$public = VkPosting::model()->findbyAttributes(array('owner'=>'writing', 'owner_id'=>$writing->id));
				if($public){
					$public->update();
					$this->_p = true;
				} else {
					$public = new VkPosting;
					$public->owner = 'writing';
					$public->owner_id = $writing->id;
					$public->save();
				}
			}
			
			return $writing;
		}

		return null;
	}

	private function getLibrary(){
		$lastTime = VkTimePosting::model()->findByPk(1);
		$time = time() - 14400;

		if($lastTime->library_last_public_time < $time){

			$criteria = new CDbCriteria;
			$criteria->condition = 'public=1';
			$criteria->addBetweenCondition('public_time', $lastTime->library_last_public_time+1, $time);
			$criteria->order = 'public_time ASC';

			$library = LibraryBook::model()->public()->find($criteria);
			if($library){
				$lastTime->library_last_public_time = strtotime( $library->public_time );
				$lastTime->update();

				$public = VkPosting::model()->findbyAttributes(array('owner'=>'library', 'owner_id'=>$library->id));
				if($public){
					$public->update();
					$this->_p = true;
				} else {
					$public = new VkPosting;
					$public->owner = 'library';
					$public->owner_id = $library->id;
					$public->save();
				}
			}
			
			return $library;
		}

		return null;
	}

	private function getAuthor(){
		$lastTime = VkTimePosting::model()->findByPk(1);
		$time = time() - 14400;

		if($lastTime->author_last_public_time < $time){

			$criteria = new CDbCriteria;
			$criteria->condition = 'public=1';
			$criteria->addBetweenCondition('public_time', $lastTime->author_last_public_time+1, $time);
			$criteria->order = 'public_time ASC';

			$author = LibraryAuthor::model()->find($criteria);
			if($author){
				$lastTime->author_last_public_time = strtotime( $author->public_time );
				$lastTime->update();

				$public = VkPosting::model()->findbyAttributes(array('owner'=>'author', 'owner_id'=>$author->id));
				if($public){
					$public->update();
					$this->_p = true;
				} else {
					$public = new VkPosting;
					$public->owner = 'author';
					$public->owner_id = $author->id;
					$public->save();
				}
			}
			
			return $author;
		}

		return null;
	}

	private function getKnowall(){
		$lastTime = VkTimePosting::model()->findByPk(1);
		$time = time() - 14400;

		if($lastTime->knowall_last_public_time < $time){

			$criteria = new CDbCriteria;
			$criteria->condition = 'public=1';
			$criteria->addBetweenCondition('public_time', $lastTime->knowall_last_public_time+1, $time);
			$criteria->order = 'public_time ASC';

			$knowall = Knowall::model()->public()->find($criteria);
			if($knowall){
				$lastTime->knowall_last_public_time = strtotime( $knowall->public_time );
				$lastTime->update();

				$public = VkPosting::model()->findbyAttributes(array('owner'=>'knowall', 'owner_id'=>$knowall->id));
				if($public){
					$public->update();
					$this->_p = true;
				} else {
					$public = new VkPosting;
					$public->owner = 'knowall';
					$public->owner_id = $knowall->id;
					$public->save();
				}
			}
			

			return $knowall;
		}

		return null;
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





