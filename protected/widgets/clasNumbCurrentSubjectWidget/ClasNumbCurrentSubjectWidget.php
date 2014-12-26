<?php

class ClasNumbCurrentSubjectWidget extends CWidget{

	public $params = array();
	public $subject = null;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

		$clasWithCurrentSubject = array();
		foreach($this->controller->allClasModel as $oneClas){
			foreach( $oneClas->gdz_subject as $oneGdzSubgect ){
				if($oneGdzSubgect->subject->id == $this->subject->id){
					$clasWithCurrentSubject[] = $oneClas;
				}
			}
		}

       // передаем данные в представление виджета
       $this->render( 'index',array('model' => $clasWithCurrentSubject) );
   }

}