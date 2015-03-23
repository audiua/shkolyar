<?php

/**
 * конроллер учебников
 */
class TextbookController extends FrontController{

public $layout='';
public $canonical;

// 4 hour
const CACHE_TIME = 14440;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='Підручники, підручники онлайн, шкільні підручники';

/**
 * @var string  мета тег описания страницы
 */
public $description='Підручники для середніх загальноосвітніх шкіл України';


// кешируем модели для виджетов
public $allClasModel;
public $clasModel;
public $subjectModel;
public $bookModel;

public $nested;
public $param;
public $h1='';


public function init(){
	$this->param = $this->getActionParams();
	$this->pageTitle = 'Підручники, підручники онлайн, шкільні підручники';

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
	if($this->beginCache('main-textbook-page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('page'))) ){

		$this->breadcrumbs = array(
			'Підручники'
		);

		$this->allClasModel = TextbookClas::model()->cache(86400)->findAll();

		$criteria = new CDbCriteria;
		$criteria->condition= 't.public=1';
		$criteria->addCondition('t.public_time<'.time());

		$textbooks = new CActiveDataProvider('TextbookBook',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));

		$this->canonical = Yii::app()->createAbsoluteUrl('/');

		// кешируем сдесь всю страницу
		$this->render('index', array('books'=>$textbooks));

		$this->endCache(); 
	}

}

/**
 * [actionClas description]
 * @return [type] [description]
 */
public function actionClas($clas){

	// TODO - закешировать на сутки
	if($this->beginCache('clas_textbook_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'page'))) ){

		$this->checkClas($clas);
		$this->clasModel = $this->loadClas($clas);

		$this->setMeta();
		$this->canonical = Yii::app()->createAbsoluteUrl('/textbook/'.$clas);
		
		$this->breadcrumbs = array(
			'Підручники' => $this->createUrl('/textbook'),
			$clas . ' клас'
		);


		$this->keywords = 'Підручники '.$clas.' клас, Підручники онлайн '.$clas. ' клас, Підручники '.$clas. ' клас україна, Підручники '.$this->clasModel->clas->title.' клас';
		$this->description = 'Підручники для ' . $clas . ' класу середніх загальноосвітніх шкіл України.';


		$criteria = new CDbCriteria;
		$criteria->condition = 't.textbook_clas_id='.$this->clasModel->id;
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());

		$books = new CActiveDataProvider('TextbookBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12,'pageVar'=>'page'),
			)
		);

		$this->render('clas', array('books'=>$books));


		$this->endCache(); 
	}
}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionSubject($clas, $subject){

	// TODO - закешировать на сутка
	if($this->beginCache('subject_textbook_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'subject', 'page'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);

		$this->setMeta();
		$this->canonical = Yii::app()->createAbsoluteUrl('/textbook/'.$clas.'/'.$subject);

		$this->keywords = 'Підручники ' . $this->subjectModel->subject->title . ' ' 
			.$clas.' клас, Підручники онлайн '
			. $this->subjectModel->subject->title . ' ' .$clas. ' клас, Підручники '. $this->subjectModel->subject->title . ' ' .$clas. ' клас Україна';

		$this->description = 'Підручники ' 
			. $this->subjectModel->subject->title . ' ' .$clas.' клас, для середніх загальноосвітніх шкіл України.';

		$criteria = new CDbCriteria;
		$criteria->condition = 't.textbook_clas_id='.$this->clasModel->id;
		$criteria->addCondition('t.textbook_subject_id='.$this->subjectModel->id);
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());

		$books = new CActiveDataProvider('TextbookBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12,'pageVar'=>'page'),
			)
		);

		$this->breadcrumbs = array(
			'Підручники' => $this->createUrl('/textbook'),
			$clas . ' клас' => $this->createUrl('/textbook/'.$clas),
			$this->subjectModel->subject->title
		);


		$this->render('subject', array('books'=>$books));

		$this->endCache(); 
	}
}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionCurrentSubject($subject){

	// TODO - закешировать на сутка
	if($this->beginCache('textbook_current_subject_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('subject', 'page'))) ){

		// все классы
		$this->allClasModel = TextbookClas::model()->cache(86400)->findAll();

		$this->checkSubject($subject);

		$subjectModel = Subject::model()->findByAttributes(array('slug'=>$subject));
		if(!$subjectModel){
			throw new CHttpException('404', 'немае такого предмету');
		}

		$description = $this->getDescription($subjectModel->id);

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());

		if($subjectModel){
			$curentSubjectModel = array_keys( CHtml::listData( TextbookSubject::model()->findAllByAttributes(array('subject_id'=>$subjectModel->id)), 'id', 'id' ) );
			// unset($subjectModel);
			if($curentSubjectModel){
				$criteria->addInCondition('textbook_subject_id', $curentSubjectModel);
				unset($curentSubjectModel);
			}
		}

		$books = new CActiveDataProvider('TextbookBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12,'pageVar'=>'page'),
			)
		);

		$this->keywords = 'Підручники ' . $subjectModel->title;

		$this->description = 'Підручники ' 
			. $subjectModel->title . ' для середніх загальноосвітніх шкіл України.';

		$this->h1 = 'Підручники '.$subjectModel->title;
		$this->pageTitle = $this->h1;
		$this->canonical = Yii::app()->createAbsoluteUrl('/textbook/'.$subject);

		$this->breadcrumbs = array(
			'Підручники' => $this->createUrl('/textbook'),
			$subjectModel->title
		);

		$this->render('current_subject', array('books' => $books, 'subject'=>$subjectModel, 'description'=>$description));

		$this->endCache(); 
	}
}


/**
 * [actionBook description]
 * @return [type] [description]
 */
public function actionBook( $clas, $subject, $book ){


	// TODO - закешировать на сутка
	if($this->beginCache('book_textbook_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'subject', 'book'))) ){

		$path = Yii::app()->theme->basePath;
	    $mainAssets = Yii::app()->AssetManager->publish($path);
		Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/panzoom.js', CClientScript::POS_END);

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);

		$this->setMeta();
		$this->keywords = 'Підручник ' . $this->subjectModel->subject->title . ' ' 
			.$clas.' клас ' . $this->bookModel->author;

		$this->description = 'Підручник ' 
			. $this->subjectModel->subject->title . ' ' .$clas.' клас ' . $this->bookModel->author . ' для середніх загальноосвітніх шкіл України.';

		$this->breadcrumbs = array(
			'Підручники' => $this->createUrl('/textbook'),
			$clas . ' клас' => $this->createUrl('/textbook/'.$clas),
			$this->subjectModel->subject->title => $this->createUrl('/textbook/'.$clas.'/'.$subject),
			$this->bookModel->author
		);

		$this->render('book');
		$this->endCache(); 
	
	}
}


/**
 * 
 * @return [type] [description]
 */
public function actionTask($clas, $subject, $book, $task){

	// TODO - закешировать на сутка
	if($this->beginCache('task_textbook_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas','subject','book','task'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);


		$pathImg['path'] = 'textbook/' . $clas . '/' 
		. $subject . '/' 
		. $book . '/task/'
		. $task .'.png';
		

		if( ! file_exists(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
			throw new CHttpException('404');
		}

		$imgSize = getimagesize(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
		$pathImg['width'] = $imgSize[0];
		// $pathImg['width'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . 'images/' . $pathImg['path'])[0];


		if(Yii::app()->request->isAjaxRequest){
				
			echo  CHtml::image(Yii::app()->baseUrl . '/img/' . $pathImg['path'], 
			'Підручник '
			. $this->subjectModel->subject->title . ' '
			. $clas . ' клас ' 
			. $this->bookModel->author
			. ' сторінка '
			. $task,
			array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'], 'title'=> 'Підручник '
			. $this->subjectModel->subject->title . ' '
			. $clas . ' клас ' 
			. $this->bookModel->author
			. ' сторінка '
			. $task));

			$this->endCache(); 
			
			Yii::app()->end();

	    } else {
	    	$this->render('task', array('task'=>$pathImg));
	    }

		$this->endCache(); 
	
	}

}	

/**
 * [loadGdzClas description]
 * @param  [type] $clas [description]
 * @return [type]       [description]
 */
private function loadClas($clas, $category = 'textbook'){

	$model = ucfirst($category) . 'Clas';
	$clasModel = Clas::model()->find('slug=:clas',array(':clas'=>(int)$clas));
	if( ! $clasModel ){
		throw new CHttpException('404', 'not clas');
	}

	$bookClasModel = $model::model()->findByAttributes(array('clas_id'=>$clasModel->id));
	// проверка на наличие обьекта класса полученного из базы
	if( ! $bookClasModel ){
		throw new CHttpException('404', 'немае такого класу');
	}
	
	return $bookClasModel;
}

/**
 * загрузка модели гдз предмета по слагу родительского предмета
 * @param  str $subject slug subject
 * @return GdzSubject
 */
private function loadSubject($subject){


	$subjectModel = Subject::model()->findByAttributes(array('slug'=>$subject));
	// модель предмета
	if( ! $subjectModel->id){
		throw new CHttpException('404', 'нет такого предмета');
	}

	// модель предмета
	$criteria=new CDbCriteria;
	$criteria->condition='textbook_clas_id=:classId';
	$criteria->addCondition('subject_id=:subjectId');
	$criteria->params = array(':classId'=>$this->clasModel->id, ':subjectId'=>$subjectModel->id);
	$bookSubjectModel = TextbookSubject::model()->find($criteria);

	// проверка на наличие предмета
	if( ! $bookSubjectModel){
		throw new CHttpException( '404', 'нет такого предмета - ' .__FILE__. ' - ' .__LINE__ );
	}
	
	return $bookSubjectModel;
}

private function loadBook($book, $category='textbook'){
	// модель книги
	$model = $model = ucfirst($category) . 'Book';
	$criteria=new CDbCriteria;
	$criteria->condition=$category.'_clas_id=:classId';
	$criteria->addCondition($category.'_subject_id=:subjectId');
	$criteria->addCondition('slug=:slug');
	$criteria->addCondition('t.public_time<'.time());
	$criteria->addCondition('t.public=1');
	$criteria->params = array(
	    ':classId'=>$this->clasModel->id, 
	    ':subjectId'=>$this->subjectModel->id,
	    ':slug'=>$book
	);
	$bookBookModel = $model::model()->find($criteria);

	// проверка на наличие учебника
	if( ! $bookBookModel ){
		throw new CHttpException('404', 'нет такого учебника');
	}

	return $bookBookModel;
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
 * [checkBook description]
 * @param  [type] $book [description]
 * @return [type]       [description]
 */
private function checkBook($book){
	if( ! $book ){
		throw new CHttpException('404', 'немае такои книги');
	}
}

private function setMeta(){
	if($this->clasModel){
		$book = $this->action->id == 'book' ? 'Підручник ' : 'Підручники ' ;
		$this->h1 = $book . $this->clasModel->clas->slug.' клас';
		$this->canonical = '/textbook/'.$this->clasModel->clas->slug;

	}

	if($this->subjectModel){
		$this->h1 .= ' ' . $this->subjectModel->subject->title . ' ';
		$this->canonical .= '/'.$this->subjectModel->subject->slug;
	}

	if($this->bookModel){
		$this->h1 .= $this->bookModel->author;
		$this->canonical .= '/'.$this->bookModel->slug;
	}

	$this->pageTitle = $this->h1;
}

public function getDescription($subject=null){

	$criteria = new CDbCriteria;
	$criteria->condition = 't.owner="'.$this->id.'"';
	$criteria->addCondition('t.action="'.$this->action->id.'"');

	if($subject){
		$criteria->addCondition('t.subject_id="'.$subject.'"');
	}

	$model = Description::model()->find($criteria);
	if($model){
		return $model->description;
	}

	return '';

}

}