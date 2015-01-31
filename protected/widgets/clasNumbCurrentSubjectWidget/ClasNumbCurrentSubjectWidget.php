<?php

class ClasNumbCurrentSubjectWidget extends CWidget{

	public $params = array();
	public $subject = null;
	public $mode;

	public function init(){
		$this->params = $this->controller->param;
		$this->mode = $this->controller->id;
        parent::init();
    }

	public function run(){
		$subject = $this->controller->id . '_subject';

		$clasWithCurrentSubject = array();
		foreach($this->controller->allClasModel as $oneClas){
			foreach( $oneClas->$subject as $oneGdzSubgect ){
				if($oneGdzSubgect->subject->id == $this->subject->id){
					$clasWithCurrentSubject[] = $oneClas;
				}
			}
		}

       // передаем данные в представление виджета
       $this->render( 'index',array('model' => $clasWithCurrentSubject) );
   }

}