<?php

class BreadcrumbsWidget extends CWidget{

	public $params = array();
	public $model = null;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

       // передаем данные в представление виджета
       $this->render('index',array('model' => $this->model));
   }

}