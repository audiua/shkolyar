<?php

class OneBookWidget extends CWidget{

	public $params = array();
	public $model = null;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

       // передаем данные в представление виджета
		$view = 'index';
		if(Yii::app()->theme->name == 'm'){
			$view = 'm_'.$view;
		}
		if($this->controller->id == 'textbook'){
			$view = 't_'.$view;

		}
       $this->render($view);
   }

}