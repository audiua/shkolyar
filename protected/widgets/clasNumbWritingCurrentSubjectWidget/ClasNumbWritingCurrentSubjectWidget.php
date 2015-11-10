<?php

class ClasNumbWritingCurrentSubjectWidget extends CWidget{

	public $params = array();
	public $subject = null;
	public $mode;

	public function init(){
		$this->params = $this->controller->param;
		$this->mode = $this->controller->id;
		$this->params['allClasModel'] = Clas::model()->findAll();
        parent::init();
    }

	public function run(){
		$time = time();
		$clasWithCurrentSubject = array();
		foreach($this->params['allClasModel'] as $oneClas){
			$flag = false;
			foreach( $oneClas->writing as $article ){
				if($article->subject->id == $this->subject->id && $article->public && $article->public_time < $time ){
					$flag = true;
				}
			}

			if($flag){
				$clasWithCurrentSubject[] = $oneClas;
			}
		}

       // передаем данные в представление виджета
		$view = 'index';
		if(Yii::app()->theme->name == 'm'){
			$view = 'm_'.$view;
		}
       $this->render( $view,array('model' => $clasWithCurrentSubject) );
   }

}