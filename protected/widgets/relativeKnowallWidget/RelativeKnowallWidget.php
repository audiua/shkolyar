<?php

class RelativeKnowallWidget extends CWidget{

	public $params = array();
	public $article;
	public $countBook = 3;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache( 'relative_knowall_article_' . $this->article->id ) ){

			// передаем данные в представление виджета
	        $this->render('index',array('model' => $this->relativeArticle($this->countBook)));

	        $this->endCache(); 
		}
    }

	private function relativeArticle($count){
		$books = array();
		$activeBook = $this->article->id;

		$criteria = new CDbCriteria;
		$criteria->condition = 't.id>'.$activeBook;
		$criteria->order = 'id';
		$criteria->limit = $this->countBook;

		$result = Knowall::model()->public()->findAll($criteria);
		if($result){
			$books = array_merge($books,$result);	
		}

		if(count($books) < $this->countBook){
			$criteria = new CDbCriteria;
			$criteria->condition = 't.id<'.$activeBook;
			$criteria->order = 'id';
			$criteria->limit = $this->countBook-count($books);

			$result = Knowall::model()->public()->findAll($criteria);
			if($result){
				$books = array_merge($books,$result);	
			}
		}

		return $books;
	}

}