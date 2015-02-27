<?php

class LibraryController extends FrontController{

// кеш на сутки 86400, 100 дней = 8640000
const CACHE_TIME = 14400;

public $layout='';
public $canonical;
public $h1='';

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='Художня література, українська література, світова  література, зарубіжна література, світова література';

/**
 * @var string  мета тег описания страницы
 */
public $description='SHKOLYAR.INFO - Художня література';

public $param;


public function init(){
	$this->param = $this->getActionParams();
}

public function filters() {
	return array(
		// array( 'COutputCache', 'duration'=> 60, ),
		// убираем дубли ссылок
		array('DuplicateFilter')
	);
}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionIndex(){
	// TODO - закешировать на сутки
	if($this->beginCache('main_library_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('page'))) ){

		$this->breadcrumbs = array(
			'Художня література'
		);

		$this->h1 = 'Художня література';

		$criteria = new CDbCriteria;
		$criteria->condition = 't.public=1';
		$criteria->addCondition('t.public_time<'.time());
		$books = new CActiveDataProvider('LibraryBook',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12)));
		
		$criteria = new CDbCriteria;
		$criteria->order = 'author ASC';
		$authors = LibraryAuthor::model()->findAll($criteria);

		$this->canonical = Yii::app()->createAbsoluteUrl('/library');
		$this->pageTitle = 'SHKOLYAR.INFO - Художня література';
		// кешируем сдесь всю страницу
		$this->render('index', array('authors'=>$authors, 'books'=>$books));
		
		$this->endCache(); 
	}

}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionCategory($category){
	// TODO - закешировать на сутки
	if($this->beginCache('category_library_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('category', 'page'))) ){

		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$category.'"';

		$categoryModel = LibraryAuthor::model()->find($criteria);
		if(!$categoryModel){
			throw new CHttpException('404', 'немає такого автора');
		}

		$criteria = new CDbCriteria;
		$criteria->condition='library_author_id='.$categoryModel->id;
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());
		$model = new CActiveDataProvider('LibraryBook',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12)));
		
		$this->breadcrumbs = array(
			'Художня література' => $this->createUrl('/library/'),
			$categoryModel->author

		);

		$this->h1 = 'Художня література ' . $categoryModel->author;
		$this->keywords = $categoryModel->author . ', Художня література '.$categoryModel->author;
		$this->description = 'Художня література '.$categoryModel->author;

		$this->canonical = Yii::app()->createAbsoluteUrl('/library/'.$category);
		$this->pageTitle = 'SHKOLYAR.INFO - Художня література '.$categoryModel->author;
		// кешируем сдесь всю страницу
		$this->render('category', array('model'=>$model, 'category'=>$categoryModel));

		$this->endCache(); 
	}

}


public function actionView($category, $article){


	if($this->beginCache('library_category_article_page_', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('category', 'article'))) ){

		$path = Yii::app()->theme->basePath;
	    $mainAssets = Yii::app()->AssetManager->publish($path);
		Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/panzoom.js', CClientScript::POS_END);

		$catModel = $this->loadCategory($category);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$article.'"';
		$criteria->addCondition('t.library_author_id='.$catModel->id);
		$article = LibraryBook::model()->find($criteria);

		$this->breadcrumbs = array(
			'Художня література' => $this->createUrl('/library/'),
			$catModel->author => $this->createUrl('/library/'.$catModel->slug),
			$article->title

		);


		$this->h1 = 'Художня література' . $catModel->author . ' ’’' . $article->title. '’’';
		$this->keywords = $catModel->author . ', Художня література '.$catModel->author . ' ’’' . $article->title. '’’';
		$this->description = 'Художня література '.$catModel->author . ' ’’' . $article->title. '’’';


		$this->canonical = Yii::app()->createAbsoluteUrl('/library/'.$category.'/'.$article->slug);
		$this->pageTitle = 'SHKOLYAR.INFO - Художня література '.$catModel->author . ' ' . $article->title;

		$this->render('view', array('model'=>$article));


		$this->endCache(); 
	}
}

public function actionTask($category, $article, $task){

	// TODO - закешировать на 30 days
	if($this->beginCache('library_task_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('category', 'article', 'task') )) ){

		$catModel = $this->loadCategory($category);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$article.'"';
		$criteria->addCondition('t.library_author_id='.$catModel->id);
		$articleModel = LibraryBook::model()->find($criteria);

		$pathImg['path'] = 'library/' . $category . '/' 
			. $article . '/book/' 
			. $task .'.png';

		if( ! file_exists( Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
			$_GET = null;
			throw new CHttpException('404');
		}

		$imgSize = getimagesize( Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
		$pathImg['width'] = $imgSize[0];
		$pathImg['height'] = $imgSize[1];
		// $pathImg['width'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . 'images/' . $pathImg['path'])[0];


		if(Yii::app()->request->isAjaxRequest){
				
			echo  CHtml::image( 
				Yii::app()->baseUrl .'/img/'.$pathImg['path'],
				'SHKOLYAR.INFO - Художня література '.$catModel->author . ' ’’' . $articleModel->title . '’’ сторінка '.$task,
			array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'],'data-height'=>$pathImg['height'], 'title'=> 'SHKOLYAR.INFO - Художня література '.$catModel->author . ' ’’' . $articleModel->title . '’’ сторінка '.$task));

			$this->endCache(); 
			
			Yii::app()->end();

	    } else {
	    	$this->render('view', array('task'=>$pathImg));
	    }


		$this->endCache(); 
	
	}
}

public function loadCategory($category){

	$criteria = new CDbCriteria;
	$criteria->condition = 't.slug="'.$category.'"';
	$model = LibraryAuthor::model()->find($criteria);

	if(! $model){
		throw new CHttpException('404', 'нет такогй автора');
	}

	return $model;

}

public function getUpdateAuthorBtn($id){
	if (Yii::app()->user->isGuest) {
		return '';
	}

	return CHtml::link('Редагувати', array('/inside/libraryAuthor/update/'.$id['id']), array('class'=>'btn btn-success btn-lg', 'target'=>'_blank'));
}

public function getUpdateBookBtn($id){
	if (Yii::app()->user->isGuest) {
		return '';
	}

	return CHtml::link('Редагувати', array('/inside/libraryBook/update/'.$id['id']), array('class'=>'btn btn-success btn-lg', 'target'=>'_blank'));
}





}