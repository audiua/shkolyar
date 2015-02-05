<?php

class RelativeTextbookWidget extends CWidget{

	public $params = array();

	public $countBook = 3;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('relative_textbook_books_'.$this->controller->bookModel->id) ){

			// передаем данные в представление виджета
	        $this->render('index',array('model' => $this->relativeBooks($this->countBook)));

	        $this->endCache(); 
		}
    }

	private function relativeBooks($count){
		$books = array();
		$activeBook = $this->controller->bookModel->id;

		$criteria = new CDbCriteria;
		$criteria->condition = 't.id>'.$activeBook;
		$criteria->addCondition('t.textbook_clas_id ='.$this->controller->bookModel->textbook_clas_id);
		$criteria->order = 'id';
		$criteria->limit = $this->countBook;

		$result = TextbookBook::model()->public()->findAll($criteria);
		if($result){
			$books = array_merge($books,$result);	
		}

		if(count($books) < $this->countBook){
			$criteria = new CDbCriteria;
			$criteria->condition = 't.id<'.$activeBook;
			$criteria->addCondition('t.textbook_clas_id ='.$this->controller->bookModel->textbook_clas_id);
			$criteria->order = 'id';
			$criteria->limit = $this->countBook-count($books);

			$result = TextbokBook::model()->public()->findAll($criteria);
			if($result){
				$books = array_merge($books,$result);	
			}
		}

		return $books;
	}

}