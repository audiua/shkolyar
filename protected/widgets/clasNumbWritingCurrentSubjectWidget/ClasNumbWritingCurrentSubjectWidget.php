<?php

class ClasNumbWritingCurrentSubjectWidget extends CWidget{

	public $params = array();
	public $subject = null;
	public $mode;

	public function init(){
		$this->params = $this->controller->param;
		$this->mode = $this->controller->id;
		$this->params['allClasModel'] = Clas::model()->findAll();
        parent::init();
    }

	public function run(){

		$clasWithCurrentSubject = array();
		foreach($this->params['allClasModel'] as $oneClas){
			foreach( $oneClas->writing as $article ){
				if($article->subject->id == $this->subject->id){
					$clasWithCurrentSubject[] = $oneClas;
				}
			}
		}

       // передаем данные в представление виджета
       $this->render( 'index',array('model' => $clasWithCurrentSubject) );
   }

}