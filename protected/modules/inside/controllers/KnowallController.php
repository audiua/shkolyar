<?php

class KnowallController extends InsideController
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
	public function actionCreate(){


		$model=new Knowall;

		$data = Yii::app()->getRequest()->getPost('Knowall', null);
		if (!empty($data)) {
			$model->thumbnail = CUploadedFile::getInstance($model, 'thumbnail');
			$model->attributes = $data;

			if($model->save()){
				Yii::app()->user->setFlash('Knowall_FLASH', 'Збережено');
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
		
		$data = Yii::app()->getRequest()->getPost('Knowall', null);
		if (!empty($data)) {
			// print_r($data);
			// die;
			$model->thumbnail = CUploadedFile::getInstance($model, 'thumbnail');
			$model->attributes = $data;

			$model->nausea = $data['nausea'];

			if($model->save()){
				Yii::app()->user->setFlash('KNOWALL_FLASH', 'Збережено');
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
		} else {
			echo json_encode(array('success'=>false));
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
		$model=new Knowall('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Knowall']))
			$model->attributes=$_GET['Knowall'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Knowall the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Knowall::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Knowall $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='knowall-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
