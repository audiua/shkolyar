<?php

class WritingController extends InsideController
{
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
				'actions'=>array('index','view', 'create', 'update', 'delete', 'updateFromCalendar'),
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Writing;

		$data = Yii::app()->getRequest()->getPost('Writing', null);
		if (!empty($data)) {
			$model->thumbnail = CUploadedFile::getInstance($model, 'thumbnail');
			$model->attributes = $data;

			if($model->save()){
				Yii::app()->user->setFlash('WRITING_FLASH', 'Збережено');
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

		// print_r($_POST);
		// die;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$data = Yii::app()->getRequest()->getPost('Writing', null);
		if (!empty($data)) {
			// print_r($data);
			// die;
			$model->thumbnail = CUploadedFile::getInstance($model, 'thumbnail');
			$model->attributes = $data;

			// проверка академической тошноты
			if(	! $model->nausea ){
				$uniq = new UniqueText;
				$uniqText =  $uniq->check($model->text);
				if($uniqText['nausea']){
					$model->nausea = $uniqText['nausea'];
				}
			}

			// $model->text = Spelling::correct($model->text);

			if($model->save()){
				Yii::app()->cache->flush();
				Yii::app()->user->setFlash('Writing_FLASH', 'Твір - ['.$model->title.'] успішно бережено');
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateFromCalendar($id){

		$model=$this->loadModel($id);
		$model->public_time = Yii::app()->getRequest()->getPost('public_time', 1);

		if($model->save()){
			echo json_encode(array('success'=>true));
		}
		
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
		$model=new Writing('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Writing']))
			$model->attributes=$_GET['Writing'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Writing the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Writing::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Writing $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='writing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
