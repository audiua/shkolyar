<?php

class LastBookWidget extends CWidget{

	public $params = array();
	public $mode = 'gdz';

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('last_book_'.$this->mode, array('duration'=>3600)) ){

			// передаем данные в представление виджета
	        $this->render( 'index', array( 'model' => $this->lastBooks() ) );

	        $this->endCache(); 
		}
    }

	private function lastBooks(){
		$model = ucfirst($this->mode).'Book';
		$criteria = new CDbCriteria;
		$criteria->order = 'update_time DESC';
		$criteria->limit = 5;

		return $model::model()->public()->findAll($criteria);
	}

}