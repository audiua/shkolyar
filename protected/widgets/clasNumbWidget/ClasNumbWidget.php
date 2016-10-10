<?php

class ClasNumbWidget extends CWidget{

	public $params = array();
	public $subject = null;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

		$view = 'index';
		if(Yii::app()->theme->name == 'm'){
			$view = 'm_'.$view;
		}

       // передаем данные в представление виджета
       $this->render( $view,array('model' => $this->controller->allClasModel) );
   }

}