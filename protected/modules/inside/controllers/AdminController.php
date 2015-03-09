<?php

class AdminController extends InsideController{
	
	/**
	* @return array action filters
	*/
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules(){

		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create', 'update', 'delete', 'calendar'),
				'roles'=>array('admin'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create', 'update','calendar'),
				'roles'=>array('moderator'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','calendar'),
				'roles'=>array('user'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){

		$sapeBalance = Setting::model()->findByAttributes(array('field'=>'sape_balance'));
		$sapeDay = Setting::model()->findByAttributes(array('field'=>'sape_day'));

		$this->render('index', array('sape'=>$sapeBalance->value, 'sapeDay'=>$sapeDay->value));
	}

	public function actionCalendar(){

		$criteria = new CDbCriteria;
		$criteria->condition = '';

		$gdzModel = GdzBook::model()->findAll();
		$textbookModel = TextbookBook::model()->findAll();
		$writingModel = Writing::model()->findAll();
		$libraryBookModel = LibraryBook::model()->findAll();
		$knowallModel = Knowall::model()->findAll();
		// print_r($gdzModel);
		// die;


		// $model = array('a','aa');


		// $model=new Event('search');
		// $model->unsetAttributes();  // clear any default values
		
		// if(isset($_GET['WorkOrder'])) {
		// 	$model->attributes=$_GET['WorkOrder'];
		// }

		$this->render('calendar',array(
			'model'=>array_merge($gdzModel, $textbookModel,$writingModel,$libraryBookModel,$knowallModel),
		));
	}
}