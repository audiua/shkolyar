<?php

class GdzBookController extends Controller
{

public function filters()
{
    return array(
        'postOnly + translit',
    );
}

public function actionTranslit(){

	if (Yii::app()->request->isAjaxRequest) {
		$slug = Yii::app()->request->getPost('slug');

		if($slug){
			$gdzBook = new GdzBook;
			$gdzBook->slug = $slug;
			if($gdzBook->validate(array('slug'))){
				echo json_encode(array('success'=>true, 'translit'=>$gdzBook->slug));
			} else {
				$error = $gdzBook->getErrors();
				echo json_encode(array('success'=>false, 'translit'=>$gdzBook->slug,'error'=>$error['slug'][0]));
			}
		}
		
		Yii::app()->end();
	}
}
	

}