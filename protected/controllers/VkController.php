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
				
				if(!$model->vk_img){
					$path = 'img/gdz/'.$model->gdz_clas->clas->slug.'/'.$model->gdz_subject->subject->slug.'/'.$model->slug.'/book';
					$file = Yii::app()->basePath . '/../' . $path.'/'.$model->slug.'.'.$model->img;
					// d($file);


					$model->vk_img = $vk->upload_photo( $file, $this->gdz_album, 'гдз '.$model->title.' '.$model->author.' '.$model->gdz_clas->clas->slug.' клас', $model->slug.'.'.$model->img, $model->img );
				}	

				$model->vk_public_time = time();
				$model->update();

				$str .= $model->gdz_clas->clas->slug . ' клас ' . $model->gdz_subject->subject->title . ' ' . $model->author  . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				break;

				case 'textbook': 

				if($this->_p){
					$str .= $this->normalDate(time()).' обновлено підручник ';
				} else {
					$str .= $this->normalDate(strtotime($model->public_time)).' добавлено новий підручник ';
				}

				if(!$model->vk_img){
					$path = 'img/textbook/'.$model->textbook_clas->clas->slug.'/'.$model->textbook_subject->subject->slug.'/'.$model->slug.'/book';
					$file = Yii::app()->basePath . '/../' . $path.'/'.$model->slug.'.'.$model->img;
					// d($file);


					$model->vk_img = $vk->upload_photo( $file, $this->textbook_album, 'підручник '.$model->title.' '.$model->author.' '.$model->textbook_clas->clas->slug.' клас', $model->slug.'.'.$model->img, $model->img );
				}
				$model->vk_public_time = time();
				$model->update();

				$str .= $model->textbook_clas->clas->slug . ' клас ' . $model->textbook_subject->subject->title . ' ' . $model->author  . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				break;

				case 'writing': 

				// d($model);

				if($this->_p){
					$str = $this->normalDate(strtotime($model->public_time)).' обновлено шкільний твір по предмету '.$model->subject->title .' для ' . $model->clas->slug . ' класу на тему: '. $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				} else {
					$str = $this->normalDate(strtotime($model->public_time)).' добавлено новий шкільний твір по предмету '.$model->subject->title .' для ' . $model->clas->slug . ' класу на тему: '. $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
				}

				if(!$model->vk_img){
					
					$file = $model->getThumb();
					// d($file);


					$model->vk_img = $vk->upload_photo( Yii::app()->basePath.'/../'.$file, $this->writing_album, 'твір '.$model->subject->title.' '.$model->clas->slug.' клас', $model->title );
				}

				$model->vk_public_time = time();
				$model->update();

				break;

				case 'library': 

					if($this->_p){
						$str = $this->normalDate(strtotime($model->public_time)).' обновлено твір художньої літератури '.$model->library_author->author . ' ' . $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					} else {
						$str = $this->normalDate(strtotime($model->public_time)).' добавлено новий твір художньої літератури '.$model->library_author->author .' ' . $model->title . ' ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					}

					if(!$model->vk_img){
						
						// d($file);

						$path = Yii::app()->baseUrl . '/../img/library/'.$model->library_author->slug.'/'.$model->slug.'/book/first.'.$data->img_ext;
						
						$model->vk_img = $vk->upload_photo( $path, $this->library_album, 'твір '.$model->library_author->author , $model->title );
					}

					$model->vk_public_time = time();
					$model->update();

				break;

				case 'author': 
					Yii::app()->end();

					if($this->_p){
						$str = $this->normalDate(strtotime($model->public_time)).' обновлено данні автора '.$model->author.' у розділі художня література - ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					} else {
						$str = $this->normalDate(strtotime($model->public_time)).' добавлений новий автор '.$model->author.' з біографією та творами у розділ художня література '. Yii::app()->createAbsoluteUrl( $model->getUrl() );
					}

					if(!$model->vk_img){
						
						$file = $model->getThumb();
						// d($file);


						$model->vk_img = $vk->upload_photo( Yii::app()->basePath.'/../'.$file, $this->writing_album, 'твір '.$model->subject->title.' '.$model->clas->slug.' клас', $model->title );
					}

					$model->vk_public_time = time();
					$model->update();

				break;

				case 'knowall': 

					if($this->_p){
						$str = $this->normalDate(strtotime($model->public_time)).' обновленно статтю у розділі Всезнайка - "'.$model->title . '" ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					} else {
						$str = $this->normalDate(strtotime($model->public_time)).' добавлено нову цікаву статтю у розділ Всезнайка - "'.$model->title . '" ' . Yii::app()->createAbsoluteUrl( $model->getUrl() );
					}

					if(!$model->vk_img){
					
						$file = $model->getThumb();
						// d($file);


						$model->vk_img = $vk->upload_photo( Yii::app()->basePath.'/../'.$file, $this->knowall_album, 'цікава стаття '.$model->knowall_category->title, $model->title );
					}

					$model->vk_public_time = time();
					$model->update();

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

		$criteria = new CDbCriteria;
		$criteria->order = 'vk_public_time ASC';

		$gdz = GdzBook::model()->public()->find($criteria);
		if($gdz){

			$public = SocialPosting::model()->findbyAttributes(array('social'=>'vk','owner'=>'gdz', 'owner_id'=>$gdz->id));
			if($public){
				$this->_p = true;
			}

			$posting = new SocialPosting;
			$posting->social = 'vk';
			$posting->owner = 'gdz';
			$posting->owner_id = $gdz->id;
			$posting->save();

		}
		
		return $gdz;
	}

	private function getTextbook(){
		

		$criteria = new CDbCriteria;
		$criteria->order = 'vk_public_time ASC';
		$textbook = TextbookBook::model()->public()->find($criteria);
		if($textbook){
			$public = SocialPosting::model()->findbyAttributes(array('social'=>'vk','owner'=>'textbook', 'owner_id'=>$textbook->id));
			if($public){
				$this->_p = true;
			}

			$posting = new SocialPosting;
			$posting->social = 'vk';
			$posting->owner = 'textbook';
			$posting->owner_id = $textbook->id;
			$posting->save();
		}
		
		return $textbook;
		
	}

	private function getWriting(){

		$criteria = new CDbCriteria;
		$criteria->order = 'vk_public_time ASC';

		$writing = Writing::model()->public()->find($criteria);
		if($writing){
			
			$public = SocialPosting::model()->findbyAttributes(array('social'=>'vk','owner'=>'writing', 'owner_id'=>$writing->id));
			if($public){
				$this->_p = true;
			}

			$posting = new SocialPosting;
			$posting->social = 'vk';
			$posting->owner = 'writing';
			$posting->owner_id = $writing->id;
			$posting->save();
		}
		
		return $writing;
		
	}

	private function getLibrary(){

		$criteria = new CDbCriteria;
		$criteria->order = 'vk_public_time ASC';

		$library = LibraryBook::model()->public()->find($criteria);
		if($library){
			
			$public = SocialPosting::model()->findbyAttributes(array('social'=>'vk','owner'=>'library_book', 'owner_id'=>$library->id));
			if($public){
				$this->_p = true;
			}

			$posting = new SocialPosting;
			$posting->social = 'vk';
			$posting->owner = 'library_book';
			$posting->owner_id = $library->id;
			$posting->save();
		}
		
		return $library;
	}

	private function getAuthor(){

		$criteria = new CDbCriteria;
		$criteria->order = 'vk_public_time ASC';

		$library = LibraryAuthor::model()->public()->find($criteria);
		if($library){
			
			$public = SocialPosting::model()->findbyAttributes(array('social'=>'vk','owner'=>'library_author', 'owner_id'=>$library->id));
			if($public){
				$this->_p = true;
			}

			$posting = new SocialPosting;
			$posting->social = 'vk';
			$posting->owner = 'library_author';
			$posting->owner_id = $library->id;
			$posting->save();
		}
		
		return $library;

	}

	private function getKnowall(){


		$criteria = new CDbCriteria;
		$criteria->order = 'vk_public_time ASC';

		$knowall = Knowall::model()->public()->find($criteria);
		if($knowall){
			
			$public = SocialPosting::model()->findbyAttributes(array('social'=>'vk','owner'=>'knowall', 'owner_id'=>$knowall->id));
			if($public){
				$this->_p = true;
			}

			$posting = new SocialPosting;
			$posting->social = 'vk';
			$posting->owner = 'knowall';
			$posting->owner_id = $knowall->id;
			$posting->save();
		}
		
		return $knowall;
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





