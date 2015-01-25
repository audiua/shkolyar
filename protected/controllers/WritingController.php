<?php

class WritingController extends Controller{

const CACHE_TIME = 14400;

public $layout='';
public $canonical;
public $h1='';

public $clasModel=null;
public $subjectModel=null;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='твори, шкільні твори';

/**
 * @var string  мета тег описания страницы
 */
public $description='Шкільні твори для учнів 5-11 класів';

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
	if($this->beginCache('main_writing_page', array('duration'=>self::CACHE_TIME)) ){

		$this->breadcrumbs = array(
			'Твори'
		);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.public=1';
		$criteria->addCondition('t.public_time<'.time());
		$model = new CActiveDataProvider('Writing',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));
		
		$this->canonical = Yii::app()->createAbsoluteUrl('/writing');
		$this->pageTitle = 'SHKOLYAR.INFO - Твори';
		$this->h1 = 'Твори';
		// кешируем сдесь всю страницу
		$this->render('index', array('model'=>$model));
		
		$this->endCache(); 
	}

}

/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionClas($clas){
	// TODO - закешировать на сутки
	if($this->beginCache('writing_clas_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas'))) ){

		$this->checkClas($clas);

		$this->clasModel = $this->loadClas($clas);

		$description = $this->getDescription($this->clasModel->id);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.clas_id="'.$this->clasModel->id.'"';
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());
		$model = new CActiveDataProvider('Writing',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));
		if(!$model){
			throw new CHttpException('404');
		}

		$this->breadcrumbs = array(
			'Твори' => $this->createUrl('/writing/'),
			$clas

		);

		$this->keywords = 'твори '.$this->clasModel->slug . ' клас, твори';
		$this->description = 'твори для '.$this->clasModel->slug . ' класу ';
		$this->canonical = Yii::app()->createAbsoluteUrl('/writing'.$clas);
		$this->h1 = 'Твори '. $clas . ' клас';
		$this->pageTitle = 'SHKOLYAR.INFO - Твори '.$clas.' клас';
		// кешируем сдесь всю страницу
		$this->render('clas', array('model'=>$model, 'description'=>$description));

		$this->endCache(); 
	}

}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionSubject($clas, $subject){

	// TODO - закешировать на сутка
	if($this->beginCache('writing_subject_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'subject'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);

		$this->keywords = 'твори '.$this->clasModel->slug . ' клас, твори '.$this->subjectModel->title.', твори '.$this->clasModel->slug . ' клас '.$this->subjectModel->title;

		$this->description = 'твори для '.$this->clasModel->slug . ' класу '.$this->subjectModel->title;

		$description = $this->getDescription($this->clasModel->id, $this->subjectModel->id);

		$this->h1 = 'Твори '.(int)$clas.' клас '. $this->subjectModel->title;

		$criteria = new CDbCriteria;
		$criteria->condition = 't.clas_id="'.$this->clasModel->id.'"';
		$criteria->addCondition('t.subject_id="'.$this->subjectModel->id.'"');
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());
		$model = new CActiveDataProvider('Writing',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));
		if(!$model){
			throw new CHttpException('404', 'немає творів для данного предмету');
		}

		$this->breadcrumbs = array(
			'Твори' => $this->createUrl('/writing/'),
			$this->clasModel->slug . ' клас' => $this->createUrl('/writing/'.$clas),
			$this->subjectModel->title

		);

		$this->canonical = Yii::app()->createAbsoluteUrl('/writing'.$clas.'/'.$subject);
		$this->pageTitle = 'SHKOLYAR.INFO - Твори '.$clas.' клас ' . $this->subjectModel->title;
		// кешируем сдесь всю страницу
		$this->render('subject', array('model'=>$model, 'description'=>$description));

		$this->endCache(); 
	}
}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionCurrentSubject($subject){

	// TODO - закешировать на сутка
	if($this->beginCache('writing_current_subject_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('subject'))) ){

		$this->checkSubject($subject);
		$this->subjectModel = $this->loadSubject($subject);

		$this->keywords = 'твори, шкільні твори, твори '.$this->subjectModel->title;

		$this->description = 'твори '.$this->subjectModel->title;

		$description = $this->getDescription( null, $this->subjectModel->id);

		$this->h1 = 'Твори ' . $this->subjectModel->title;

		$criteria = new CDbCriteria;
		$criteria->condition='t.subject_id="'.$this->subjectModel->id.'"';
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());
		$model = new CActiveDataProvider('Writing',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));
		if(!$model){
			throw new CHttpException('404');
		}

		$this->breadcrumbs = array(
			'Твори' => $this->createUrl('/writing/'),
			$this->subjectModel->title,
		);

		$this->canonical = Yii::app()->createAbsoluteUrl('/writing/'.$this->subjectModel->slug);
		$this->pageTitle = 'SHKOLYAR.INFO - Твори '.$this->subjectModel->title;
		// кешируем сдесь всю страницу
		$this->render('current_subject', array('model'=>$model, 'description'=>$description));

		$this->endCache(); 
	}
}


public function actionView($clas, $category, $article){

	if($this->beginCache('article_knowall_page', array('duration'=>86400, 'varyByParam'=>array('clas, category', 'article'))) ){

		$this->checkClas($clas);
		$this->checkSubject($category);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($category);

		$criteria = new CDbCriteria;
		$criteria->condition = 't.slug="'.$article.'"';
		$criteria->addCondition('t.clas_id='.$this->clasModel->id);
		$criteria->addCondition('t.subject_id='.$this->subjectModel->id);
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());
		$article = Writing::model()->find($criteria);

		$this->breadcrumbs = array(
			'Твори' => $this->createUrl('/writing/'),
			$this->clasModel->slug . ' клас' => $this->createUrl('/writing/'.$this->clasModel->slug),
			$this->subjectModel->title => $this->createUrl('/writing/'.$this->subjectModel->slug),
			$article->title

		);

		$this->canonical = Yii::app()->createAbsoluteUrl('/writing/'.$this->clasModel->slug . '/'. $this->subjectModel->slug . '/' . $article->slug);
		$this->pageTitle = 'SHKOLYAR.INFO - Твори '.$this->clasModel->slug . ' '. $this->subjectModel->title . ' ' . $article->title;

		$this->keywords = 'твори '.$this->clasModel->slug . ' клас, твори '.$this->subjectModel->title.', твори '.$this->clasModel->slug . ' клас '.$this->subjectModel->title;
		$this->description = 'твір для '.$this->clasModel->slug . ' класу '.$this->subjectModel->title . ' на тему: '.$article->title ;

		$this->render('view', array('model'=>$article));

		$this->endCache(); 
	}
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

/**
 * [checkClas description]
 * @param  [type] $clas [description]
 * @return [type]       [description]
 */
private function checkClas($clas){
	if( (int)$clas > 11 || (int)$clas < 5 ){
		throw new CHttpException('404', 'немае такого класу');
	}
}

/**
 * [loadGdzClas description]
 * @param  [type] $clas [description]
 * @return [type]       [description]
 */
private function loadClas($clas){

	$clasModel = Clas::model()->find('slug=:clas',array(':clas'=>(int)$clas));
	if( ! $clasModel ){
		throw new CHttpException('404', 'not clas');
	}
	
	return $clasModel;
}

public function getDescription($clas=null, $subject=null){

	$criteria = new CDbCriteria;
	$criteria->condition = 't.owner="'.$this->id.'"';
	$criteria->addCondition('t.action="'.$this->action->id.'"');

	if($clas){
		$criteria->addCondition('t.clas_id="'.$clas.'"');
		
	}

	if($subject){
		$criteria->addCondition('t.subject_id="'.$subject.'"');
	}

	$model = Description::model()->find($criteria);
	if($model){
		return $model->description;
	}

	return '';

}

/**
 * [checkSubject description]
 * @param  [type] $subject [description]
 * @return [type]          [description]
 */
private function checkSubject($subject){
	if( ! $subject ){
		throw new CHttpException('404', 'немае такого предмету');
	}
}

/**
 * загрузка модели гдз предмета по слагу родительского предмета
 * @param  str $subject slug subject
 * @return GdzSubject
 */
private function loadSubject($subject){

	$subjectModel = Subject::model()->findByAttributes(array('slug'=>$subject));
	// модель предмета
	if( ! $subjectModel){
		throw new CHttpException('404', 'нет такого предмета');
	}

	return $subjectModel;
}





}