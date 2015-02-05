<?php

class RelativeLibraryWidget extends CWidget{

	public $params = array();
	public $book;
	public $countBook = 3;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('relative_library_book'.$this->book->id) ){

			// передаем данные в представление виджета
	        $this->render('index',array('model' => $this->relativeBooks($this->countBook)));

	        $this->endCache(); 
		}
    }

	private function relativeBooks($count){
		$books = array();

		$criteria = new CDbCriteria;
		$criteria->condition = 't.id>'.$this->book->id;
		$criteria->order = 'id';
		$criteria->limit = $this->countBook;

		$result = LibraryBook::model()->public()->findAll($criteria);
		if($result){
			$books = array_merge($books,$result);	
		}

		if(count($books) < $this->countBook){
			$criteria = new CDbCriteria;
			$criteria->condition = 't.id<'.$this->book->id;
			$criteria->order = 'id';
			$criteria->limit = $this->countBook-count($books);

			$result = LibraryBook::model()->public()->findAll($criteria);
			if($result){
				$books = array_merge($books,$result);	
			}
		}

		return $books;
	}

}