<?php

class LibrarySidebarMenuWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
		
        parent::init();
    }

	public function run(){

		$criteria = new CDbCriteria;
		$criteria->order = 'author ASC';
		$models = LibraryAuthor::model()->findAll($criteria);
		$categories = array();
		if($models){
			foreach($models as $model){
				if($model->library_book){
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