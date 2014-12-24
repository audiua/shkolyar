<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->renderPartial('index');
	}

	public function actionTranslit(){

		if (Yii::app()->request->isAjaxRequest) {
			$title = Yii::app()->request->getPost('title');

			if($title){
				$knowall = new Knowall;
				$knowall->slug = $title;
				if($knowall->validate(array('slug'))){
					echo json_encode(array('success'=>true, 'translit'=>$knowall->slug));
				} else {
					$error = $knowall->getErrors();
					echo json_encode(array('success'=>false, 'translit'=>$knowall->slug,'error'=>$error['slug'][0]));
				}
			}
			
			Yii::app()->end();
		}
	}



}