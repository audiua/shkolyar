<?php

class LastKnowallWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('last_knowall', array('duration'=>3600)) ){

			// передаем данные в представление виджета
	        $this->render( 'index', array( 'model' => $this->lastKnowallArticles() ) );

	        $this->endCache(); 
		}
    }

	private function lastKnowallArticles(){
		$criteria = new CDbCriteria;
		// $criteria->condition = 't.public=1';
		// $criteria->addCondition = 't.public_time > '.time();
		$criteria->order = 'create_time DESC';
		$criteria->limit = 4;

		return Knowall::model()->findAll($criteria);
	}

}