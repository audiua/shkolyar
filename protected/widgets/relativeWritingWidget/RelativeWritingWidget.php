<?php

class RelativeWritingWidget extends CWidget{

	public $params = array();
	public $article;
	public $countBook = 3;

	public function init(){
		$this->params = $this->controller->param;
        parent::init();
    }

	public function run(){
		if($this->beginCache('relative_writing_article_'. $this->article->id) ){

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
		$criteria->addCondition('t.clas_id ='.$this->article->clas_id);
		$criteria->order = 'id';
		$criteria->limit = $this->countBook;

		$result = Writing::model()->public()->findAll($criteria);
		if($result){
			$books = array_merge($books,$result);	
		}

		if(count($books) < $this->countBook){
			$criteria = new CDbCriteria;
			$criteria->condition = 't.id<'.$activeBook;
			$criteria->addCondition('t.clas_id ='.$this->article->clas_id);
			$criteria->order = 'id';
			$criteria->limit = $this->countBook-count($books);

			$result = Writing::model()->public()->findAll($criteria);
			if($result){
				$books = array_merge($books,$result);	
			}
		}

		return $books;
	}

}