<?php

class SiteController extends Controller{

public $layout='';
public $canonical;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='Шкільний інформаційний портал, гдз, підручники, підручники онлайн, всезнайка, художня література, шкільні твори';

/**
 * @var string  мета тег описания страницы
 */
public $description='SHKOLYAR.INFO - інформаційний портал, для середніх загальноосвітніх шкіл України. Данний портал створено з метою зібрати усі потрібні для навчання в школі матеріали, в одному місці, щоб зберигти Ваш час та допомогти Вам у навчанні. Команда порталу витратила чимало часу та зусиль, щоб досягнути поставленої мети.';

public $param;



public function init(){
	$this->param = $this->getActionParams();
}

public function filters() {
	return array(
		// array( 'COutputCache', 'duration'=> 60, ),
		// убираем дубли ссылок
		// array('DuplicateFilter')
	);
}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionIndex(){
	// TODO - закешировать на сутки
	if($this->beginCache('main_page', array('duration'=>86400)) ){

		$this->canonical = Yii::app()->createAbsoluteUrl('/');
		$this->pageTitle = 'SHKOLYAR.INFO - Шкільний інформаційний портал.';
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

	$description = $this->widget('DescriptionWidget', array('params'=>array('owner'=>'site', 'action'=>'page', 'page_mode'=>$action)), true);
	if($description){
		$this->render('page', array('title'=>Yii::t('app', $action), 'description'=>$description));
	} else {
		throw new CHttpException('404');
	}

}

}