<?php

class LastLibraryWidget extends CWidget{

	public $params = array();

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('last_library', array('duration'=>3600)) ){

			// передаем данные в представление виджета
	        $this->render( 'index', array( 'model' => $this->lastLibraryArticles() ) );

	        $this->endCache(); 
		}
    }

	private function lastLibraryArticles(){
		$criteria = new CDbCriteria;
		// $criteria->condition = 't.public=1';
		// $criteria->addCondition = 't.public_time > '.time();
		$criteria->order = 'create_time DESC';
		$criteria->limit = 4;

		return LibraryBook::model()->findAll($criteria);
	}

}