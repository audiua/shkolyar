<?php

class TextbookSidebarMenuWidget extends CWidget{

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
			$subject = $this->controller->subjectModel;
		} else {
			$subject = null;
		}

		if($clas){

			$criteria = new CDbCriteria;
			$criteria->condition = 't.textbook_clas_id='.$this->controller->clasModel->id;
			$criteria->addCondition('t.public=1');
			$criteria->addCondition('t.public_time<'.time());
			$criteria->group = 'textbook_subject_id';

			$subjectsIds = TextbookBook::model()->findAll($criteria);
			foreach($subjectsIds as $s){
				$ids[] = $s->textbook_subject_id;
			}

			$criteria = new CDbCriteria;
			$criteria->addInCondition('t.id', $ids);
			
			$subjects = TSubject::model()->findAll($criteria);
		} else {
			$subjects = array();

		}


       // передаем данные в представление виджета
       $this->render('index', array('clas'=>$clas,'subject'=>$subject, 'allSubjectModel'=>$subjects));
   }

}