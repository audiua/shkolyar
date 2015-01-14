<?php

class KnowallController extends Controller{

public $layout='';
public $canonical;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='SHKOLYAR.INFO - Шкільний інформаційний портал.';

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

	$page = Yii::app()->getRequest()->getParam('page', null);

	// TODO - закешировать на сутки
	if($this->beginCache('main_knowall_page'.$page, array('duration'=>86400)) ){

		$this->breadcrumbs = array(
			'Всезнайка'
		);

		$criteria = new CDbCriteria;
		$criteria->condition= 't.public=1';


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
		$this->pageTitle = 'SHKOLYAR.INFO - Всезнайка';
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

	$page = Yii::app()->getRequest()->getParam('page', null);
	// TODO - закешировать на сутки
	if($this->beginCache('category_knowall_page'.$category.$page, array('duration'=>86400, 'varyByParam'=>array('category'))) ){

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
		$criteria->addCondition('knowall_category_id='.$categoryModel->id);
		$model = new CActiveDataProvider('Knowall',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>2,'pageVar'=>'page')));

		$this->canonical = Yii::app()->createAbsoluteUrl('/'.$category);
		$this->pageTitle = 'SHKOLYAR.INFO - Всезнайка - '.ucfirst(Yii::t('app', $category));
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
		$criteria->addCondition('t.knowall_category_id='.$catModel->id);
		$article = Knowall::model()->find($criteria);

		$this->breadcrumbs = array(
			'Всезнайка' => $this->createUrl('/knowall/'),
			Yii::t('app', $category) => $this->createUrl('/knowall/'.$category),
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
	$model = KnowallCategory::model()->find($criteria);

	if(! $model){
		throw new CHttpException('404', 'нет такогй категории');
	}

	return $model;

}





}