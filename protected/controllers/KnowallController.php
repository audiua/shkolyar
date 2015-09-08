<?php

class KnowallController extends FrontController{

public $layout='';
public $canonical;
public $h1;
const CACHE_TIME = 14400;
/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='Всезнайка';

/**
 * @var string  мета тег описания страницы
 */
public $description='Всезнайка';

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
	if($this->beginCache('main_knowall_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('page'))) ){

		$this->breadcrumbs = array(
			'Всезнайка'
		);

		$criteria = new CDbCriteria;
		$criteria->condition= 't.public=1';
		$criteria->addCondition('t.public_time<'.time());


		$model = new CActiveDataProvider(
			'Knowall',
			array(
				'criteria'=>$criteria,
				'pagination'=>array(
					'pageSize'=>12,
					'pageVar'=>'page'
				)
			)
		);

		$category = KnowallCategory::model()->findAll();

		$this->canonical = Yii::app()->createAbsoluteUrl('/knowall');
		$this->pageTitle = 'Всезнайка';
		// кешируем сдесь всю страницу
		$this->render('index', array('model'=>$model, 'category'=>$category));
		

		$this->endCache(); 
	}

}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionCategory($category){

	// TODO - закешировать на сутки
	if($this->beginCache('category_knowall_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('category', 'page'))) ){

		$this->breadcrumbs = array(
			'Всезнайка' => $this->createUrl('/knowall/'),
			Yii::t('app', $category)

		);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$category.'"';

		$categoryModel = KnowallCategory::model()->find($criteria);
		if(!$categoryModel){
			throw new CHttpException('404', 'error');
		}


		$criteria = new CDbCriteria;
		$criteria->condition= 't.public=1';
		$criteria->addCondition('t.public_time<'.time());
		$criteria->addCondition('knowall_category_id='.$categoryModel->id);
		$model = new CActiveDataProvider('Knowall',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));

		$this->keywords = 'Всезнайка, '.$categoryModel->title;
		$this->description = 'Всезнайка '.$categoryModel->title;

		$this->canonical = Yii::app()->createAbsoluteUrl('/knowall/'.$category);
		$this->pageTitle = 'Всезнайка '.$categoryModel->title;
		// кешируем сдесь всю страницу
		$this->render('category', array('model'=>$model, 'category'=>$categoryModel));

		$this->endCache(); 
	}

}


public function actionView($category, $article){

	if($this->beginCache('article_knowall_page_', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('category', 'article'))) ){

		$catModel = $this->loadCategory($category);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$article.'"';
		$criteria->addCondition('t.public_time<'.time());
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.knowall_category_id='.$catModel->id);
		$article = Knowall::model()->find($criteria);

		$this->breadcrumbs = array(
			'Всезнайка' => $this->createUrl('/knowall/'),
			Yii::t('app', $category) => $this->createUrl('/knowall/'.$category),
			$article->title

		);

		$this->keywords = 'Всезнайка, ' . $catModel->title . ', '. $article->title;
		$this->description = 'Всезнайка '.$catModel->title . ' '. $article->title;
		$this->pageTitle = 'Всезнайка '.$catModel->title . ' ' . $article->title;

		$this->render('view', array('model'=>$article));


		$this->endCache(); 
	}
}

public function loadCategory($category){

	$criteria = new CDbCriteria;
	$criteria->condition = 't.slug="'.$category.'"';
	$model = KnowallCategory::model()->find($criteria);

	if(! $model){
		throw new CHttpException('404', 'нет такогй категории');
	}

	return $model;

}

}