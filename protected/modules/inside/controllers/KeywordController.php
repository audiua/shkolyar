<?php

class KeywordController extends InsideController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'position','view', 'create', 'update', 'delete', 'pageWeight', 'pageWeightView'),
				'roles'=>array('admin'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create', 'update'),
				'roles'=>array('moderator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'item'=>$this->loadModel($id)->six(),
			'model'=>$this->loadModel($id)
		));
	}

	public function actionPageWeight() {

		// d('oops');
		$model = new PageWeight('search');
		$model->unsetAttributes();

		$data = Yii::app()->getRequest()->getParam('PageWeight', null);
		if (!empty($data)) { $model->attributes = $data;}

		$this->render('pageWeight', array(
			'model' => $model,
		));
	}

	public function actionPageWeightView($id) {

		$pageModel = PageWeight::model()->findByPk($id);

		// d('oops');
		$criteria = new CDbCriteria;
		$criteria->condition = 't.page_in='.$id;
		$models = PageWeightList::model()->findAll($criteria);
		$linksInIds = [];
		foreach($models as $model){
			$linksInIds[] = $model->page_out;
		}
		$criteria = new CDbCriteria;
		$criteria->addInCondition('id', $linksInIds);;
		$linksIn = PageWeight::model()->findAll($criteria);
		

		$criteria = new CDbCriteria;
		$criteria->condition = 't.page_out='.$id;
		$models = PageWeightList::model()->findAll($criteria);
		$linksOutIds = [];
		foreach($models as $model){
			$linksOutIds[] = $model->page_in;
		}
		$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$linksOutIds);;
		$linksOut = PageWeight::model()->findAll($criteria);


		$this->render('pageWeightView', array(
			'model'=>$pageModel,
			'linksIn' => $linksIn,
			'linksOut' => $linksOut,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Keyword;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Keyword']))
		{
			$model->attributes=$_POST['Keyword'];
			if($model->save()){
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Keyword']))
		{
			$model->attributes=$_POST['Keyword'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Keyword('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Keyword']))
			$model->attributes=$_GET['Keyword'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Keyword the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Keyword::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Keyword $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='keyword-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
