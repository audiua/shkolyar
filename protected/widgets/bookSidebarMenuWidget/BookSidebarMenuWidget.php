<?php

class BookSidebarMenuWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

		if( isset($this->params['clas']) ){
			$clas = $this->params['clas'];
		} else {
			$clas = 0;
		}

		if( isset($this->params['subject']) ){
			$subject = $this->params['subject'];
		} else {
			$subject = '';
		}

		if( ! $this->controller->allClasModel){
			$this->controller->allClasModel = GdzClas::model()->findAll();
		}

		$criteria = new CDbCriteria;
		$criteria->order = 'title';
		$allSubjectModel = Subject::model()->findAll($criteria);

       // передаем данные в представление виджета
       $this->render('index', array('clas'=>$clas, 'allSubjectModel'=>$allSubjectModel, 'subject'=>$subject));
   }

}