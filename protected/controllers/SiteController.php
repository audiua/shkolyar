<?php

class SiteController extends Controller{

public $layout='';
public $canonical;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='SHKOLYAR.INFO - Шкільний інформаційний портал.';

/**
 * @var string  мета тег описания страницы
 */
public $description='SHKOLYAR.INFO - информацийний портал, для середніх загальноосвітніх шкіл України.';

public $param;



public function init(){
	$this->param = $this->getActionParams();
}

/**
 * Declares class-based actions.
 */
public function actions(){

	return array(
		// page action renders "static" pages stored under 'protected/views/site/pages'
		// They can be accessed via: index.php?r=site/page&view=FileName
		'page'=>array(
			'class'=>'CViewAction',
		),
	);
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
		$this->pageTitle = 'SHKOLYAR.INFO - Шкильний информацийний портал';
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
		if(Yii::app()->request->isAjaxRequest)
			echo $error['message'];
		else
			$this->render('error', $error);
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



}