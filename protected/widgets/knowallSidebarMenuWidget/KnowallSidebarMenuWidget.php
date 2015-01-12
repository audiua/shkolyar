<?php

class KnowallSidebarMenuWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
		
        parent::init();
    }

	public function run(){

		$models = KnowallCategory::model()->findAll();
		$categories = array();
		if($models){
			foreach($models as $model){
				if($model->knowall){
					$categories[] = $model;
				}
			}
		}

		if( isset($this->params['category']) ){
			$category = $this->params['category'];
		} else {
			$category = null;
		}

       // передаем данные в представление виджета
       $this->render('index', array('categories'=>$categories, 'category'=>$category));
   }

}