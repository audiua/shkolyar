<?php

class RelativeGdzWidget extends CWidget{

	public $params = array();

	public $countBook = 3;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('relative_books', array('duration'=>86400)) ){

			// передаем данные в представление виджета
	        $this->render('index',array('model' => $this->randomBooks($this->countBook)));

	        $this->endCache(); 
		}
    }

	private function randomBooks($count){
		$countBook = GdzBook::model()->count();
		$randIdBooks = array();
		$books = array();
		while( $count > count($books) ){
			$rand = mt_rand(1,$countBook);
			if(!in_array($rand ,$randIdBooks)){
				$randIdBooks[] = $rand;

				$bookModel = GdzBook::model()->findByPk($rand);
				if($bookModel){
					$books[] = $bookModel;
				}

			}
		}

		return $books;
	}

}