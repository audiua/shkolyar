<?php

class BookSidebarMenuWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

		if( isset($this->params['clas']) ){
			$clas = $this->controller->clasModel;
		} else {
			$clas = null;
		}

		if( isset($this->params['subject']) ){
			$subject = Subject::model()->findByAttributes(array('slug'=>$this->params['subject']));
		} else {
			$subject = null;
		}

		if( ! $this->controller->allClasModel){
			$clasName = ucfirst($this->controller->id).'Clas';
			$this->controller->allClasModel = $clasName::model()->findAll();
		}

		$subjectName = ucfirst($this->controller->id).'Subject';
		$criteria = new CDbCriteria;

		if($clas){
			$criteria->condition = $this->controller->id . '_clas_id='.$clas->id;
		}

		$criteria->order = "'title ASC'";
		$criteria->group = 'subject_id';
		$allSubjectModel = $subjectName::model()->findAll($criteria);

       // передаем данные в представление виджета
       $this->render('index', array('clas'=>$clas, 'allSubjectModel'=>$allSubjectModel, 'subject'=>$subject));
   }

}