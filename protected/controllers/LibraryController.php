<?php

class LibraryController extends Controller{

public $layout='';
public $canonical;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='';

/**
 * @var string  мета тег описания страницы
 */
public $description='SHKOLYAR.INFO - информацийний портал, для середніх загальноосвітніх шкіл України.';

public $param;


public function init(){
	$this->param = $this->getActionParams();
}

public function filters() {
	return array(
		// array( 'COutputCache', 'duration'=> 60, ),
		// убираем дубли ссылок
		// array('DuplicateFilter')
	);
}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionIndex(){
	// TODO - закешировать на сутки
	if($this->beginCache('main_library_page', array('duration'=>86400)) ){

		$this->breadcrumbs = array(
			'Художня література'
		);

		$criteria = new CDbCriteria;
		// $criteria->condition= 't.public=1';
		$books = new CActiveDataProvider('LibraryBook',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12)));
		$authors = LibraryAuthor::model()->findAll();

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
	if($this->beginCache('category_library_page', array('duration'=>86400, 'varyByParam'=>array('category'))) ){


		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$category.'"';

		$categoryModel = LibraryAuthor::model()->find($criteria);
		if(!$categoryModel){
			throw new CHttpException('404', 'немає такого автора');
		}


		$criteria = new CDbCriteria;
		$criteria->condition='library_author_id='.$categoryModel->id;
		// $criteria->condition= 't.public=1';
		$model = new CActiveDataProvider('LibraryBook',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12)));
		
		$this->breadcrumbs = array(
			'Художня література' => $this->createUrl('/library/'),
			$categoryModel->author

		);

		$this->canonical = Yii::app()->createAbsoluteUrl('/'.$category);
		$this->pageTitle = 'SHKOLYAR.INFO - Художня література - '.ucfirst(Yii::t('app', $category));
		// кешируем сдесь всю страницу
		$this->render('category', array('model'=>$model, 'category'=>$categoryModel));

		$this->endCache(); 
	}

}


public function actionView($category, $article){

	// if($this->beginCache('article_knowall_page_'.$category.$article, array('duration'=>86400, 'varyByParam'=>array('category', 'article'))) ){


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


		$this->render('view', array('model'=>$article));


	// 	$this->endCache(); 
	// }
}
	

	
/**
 * This is the action to handle external exceptions.
 */
public function actionError()
{
	if($error=Yii::app()->errorHandler->error)
	{
		if(Yii::app()->request->isAjaxRequest)
			echo $error['message'];
		else
			$this->render('error', $error);
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





}