<?php

class LastWritingWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('last_writing', array('duration'=>3600)) ){

			// передаем данные в представление виджета
	        $this->render( 'index', array( 'model' => $this->lastWritingArticles() ) );

	        $this->endCache(); 
		}
    }

	private function lastWritingArticles(){
		$criteria = new CDbCriteria;
		$criteria->condition = 't.public=1';
		$criteria->addCondition('t.public_time < '.time() );
		$criteria->order = 'public_time DESC';
		$criteria->limit = 4;

		return Writing::model()->findAll($criteria);
	}

}