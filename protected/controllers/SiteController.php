<?php

class SiteController extends FrontController{

public $layout='';
public $canonical;
const CACHE_TIME = 7200;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='гдз, готові домашні завдяння, гдз онлайн, підручники, підручники онлайн, всезнайка, художня література, шкільні твори';

/**
 * @var string  мета тег описания страницы
 */
public $description='Шкільний інформаційний портал, для середніх загальноосвітніх шкіл України. Даний портал створено з метою зібрати усі потрібні для навчання в школі матеріали, в одному місці.';

public $param;



public function init(){
	$this->param = $this->getActionParams();
}

public function filters() {
	return array(
		// array( 'COutputCache', 'duration'=> 60, ),
		// убираем дубли ссылок
		array('DuplicateFilter')
	);
}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionIndex(){


	// foreach(Keyword::model()->findAll() as $item ){
	// 	echo $item->keyword;
	// 	echo '<br>';
	// }

	// die;


	// $image = new TextInImgHelper;
	// $image->create();
	// die;

	// Yii::import('ext.qrcode.QRCode');
	// $code=new QRCode(uniqid().md5(time()));
	// to save the code to file
	// d(Yii::getPathOfAlias('webroot').'/img/qr/file.png');
	// $code->create();
	// $code->create(Yii::getPathOfAlias('webroot').'/img/qr/file'.time().'.png');

	// TODO - закешировать на сутки
	if($this->beginCache('main_page'.Yii::app()->theme->name, array('duration'=>self::CACHE_TIME)) ){

		$this->canonical = Yii::app()->createAbsoluteUrl('/');
		$this->pageTitle = 'Гдз, готові домашні завдяння, гдз онлайн, підручники, твори, художня література, всезнайка';
		// кешируем сдесь всю страницу
		$this->render('index');

		$this->endCache(); 
	}

}
	
/**
 * This is the action to handle external exceptions.
 */
public function actionError()
{
	if($error=Yii::app()->errorHandler->error)
	{
		if(Yii::app()->request->isAjaxRequest){
			echo $error['message'];
		} else {
			$this->pageTitle=Yii::app()->name . ' - Error '.$error['code'];
			$this->render('error'.$error['code'], $error);
		}
	}
}


/**
 * [actionSearch description]
 * @return [type] [description]
 */
public function actionSearch(){
	// echo 'oops';
	// die;

	$clas = (int)trim(Yii::app()->request->getParam('c', null));
	$subject = trim(Yii::app()->request->getParam('s', null));
	$author = trim(Yii::app()->request->getParam('a', null));


	$criteria = new CDbCriteria;

	if($clas){
		$clasModel = Clas::model()->findByAttributes(array('slug'=>$clas));
		if($clasModel){

			$curentClasModel = GdzClas::model()->findByAttributes(array('clas_id'=>$clasModel->id));
			unset($clasModel);
			if($curentClasModel){
				$criteria->addCondition('t.gdz_clas_id='.(int)$curentClasModel->id);
				unset($curentClasModel);
			}
		}
	}

	if($subject){
		$subjectModel = Subject::model()->findByAttributes(array('title'=>ucfirst($subject)));
		if($subjectModel){

			$curentSubjectModel = array_keys( CHtml::listData( GdzSubject::model()->findAllByAttributes(array('subject_id'=>$subjectModel->id)), 'id', 'id' ) );
			unset($subjectModel);
			if($curentSubjectModel){
				$criteria->addInCondition('gdz_subject_id', $curentSubjectModel);
				unset($curentSubjectModel);
			}
		}
	}

	if($author){
		$match = addcslashes($author, '%_'); // escape LIKE's special characters
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('author', $match);
		 
		$currentAuthorModel = array_keys( CHtml::listData( GdzBook::model()->findAll( $criteria ), 'id', 'id') ); 
		// print_r($currentAuthorModel );
		// die;
		if($currentAuthorModel){
			$criteria->addInCondition('id', $currentAuthorModel);
				unset($curentSubjectModel);
		}    
	}

	// if($author){
	// 	$criteria->addCondition();
	// }

	$books = new CActiveDataProvider('GdzBook', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12)));
	// print_r($books);
	// die;

	$this->render('search', array('dataProvider'=>$books)) ;

}

/**
 * Displays the login page
 */
public function actionLogin(){


	// авторизация только после получения куки на 1 мин
	$model = Setting::model()->findByAttributes(array('field'=>'cookie_token'));
	if( ! $model){
		throw new CHttpException('404');
	}

	$token = Yii::app()->request->cookies['cookie_token'];
	if( ! $token ){
		throw new CHttpException('404');
	}

	$value = unserialize($model->value);
	if( $value['expire'] < time() || $token->value !== $value['token'] ){
		throw new CHttpException('404');
	}


	$this->layout = '//layouts/login';
	$model=new LoginForm;


	// if it is ajax validation request
	if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
		echo CActiveForm::validate($model);
		Yii::app()->end();
	}

	// collect user input data
	if(isset($_POST['LoginForm'])){
		$model->attributes=$_POST['LoginForm'];
		// validate user input and redirect to the previous page if valid
		if($model->validate() && $model->login()){
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
	// display the login form
	$this->render('login',array('model'=>$model));
}

/**
 * Logs out the current user and redirect to homepage.
 */
public function actionLogout(){
	Yii::app()->user->logout();
	$this->redirect(Yii::app()->homeUrl);
}

public function actionPage($action){

	$this->description = 'shkolyar.info '.$action;
	$this->keywords = $action;
	$this->pageTitle = 'shkolyar.info '.$action;

	$description = $this->widget('DescriptionWidget', array('params'=>array('owner'=>'site', 'action'=>'page', 'page_mode'=>$action)), true);
	if($description){
		$this->render('page', array('title'=>Yii::t('app', $action), 'description'=>$description));
	} else {
		throw new CHttpException('404');
	}

}

public function actionJewel(){
	$token = sha1( uniqid() );

	// echo $token;
	$cookie = new CHttpCookie('cookie_token', $token );

	// print_r($cookie);
	$cookie->expire = time() + 60; // 1 min
	Yii::app()->request->cookies['cookie_token'] = $cookie;

	$model = Setting::model()->findByAttributes(array('field'=>'cookie_token'));
	if($model){
		$model->value = serialize(
			array(
				'expire'=>$cookie->expire,
				'token'=>$token
			)
		);

		if($model->update()){
			$this->redirect('/login');
		}
	}
}


public function actionOauth()
{

    $code = Yii::app()->request->getParam('code');
    if(!empty($code))
    {
        Yii::import('ext.ya.YaUniqueText');

        $params = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => YaUniqueText::APP_ID,
            'client_secret' => YaUniqueText::APP_PASSWORD,
        );

        $curl = curl_init('http://oauth.yandex.ru/token');
        curl_setopt_array($curl,array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params,
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        if(!empty($result))
        {
            $data = json_decode($result);

            Yii::app()->request->cookies['ya_access_token'] = new CHttpCookie('ya_access_token',$data->access_token,
                array(
                    'expire'=>time()+$data->expires_in
                )
            );
        }

        $state = Yii::app()->request->getParam('state');
        if(!empty($state))
        {
            $state = base64_decode($state);
            $this->redirect($state);
        }
    }
}

public function actionRemovePage(){
	throw new CHttpException('410');
}






}