<?php

class WritingSidebarMenuWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

		if( isset($this->params['clas']) ){

			// $clas = $this->controller->clasModel;
			$clas = Clas::model()->findByAttributes(array('slug'=>$this->params['clas']));
		} else {
			$clas = null;
		}

		if( isset($this->params['subject']) ){
			$subject = Subject::model()->findByAttributes(array('slug'=>$this->params['subject']));
		} else {
			$subject = null;
		}

		$this->params['allClasModel'] = Clas::model()->findAll();
		$criteria = new CDbCriteria;
		$criteria->order = "'title ASC'";
		// $criteria->group = 'subject_id';
		$allSubjectModel = Subject::model()->findAll($criteria);

       // передаем данные в представление виджета
       $this->render('index', array('clas'=>$clas, 'allSubjectModel'=>$allSubjectModel, 'subject'=>$subject));
   }

}