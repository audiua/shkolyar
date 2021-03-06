<?php

class GdzController extends FrontController{

// кеш на сутки 86400
const CACHE_TIME = 14400;

public $layout='';
public $canonical;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='готові домашні завдання, гдз, гдз онлайн, гдз україна, гдз решебники, gdz, гдз скачать, збірники гдз';

/**
 * @var string  мета тег описания страницы
 */
public $description='ГДЗ - готові домашні завдання онлайн, для середніх загальноосвітніх шкіл України.';


// кешируем модели для виджетов
public $allClasModel=null;
public $clasModel=null;
public $subjectModel=null;
public $bookModel=null;

public $nested;
public $param;

public $h1='';



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
 * [beforeAction description]
 * @param  [type] $action [description]
 * @return [type]         [description]
 */
public function beforeAction($action){
    return parent::beforeAction($action);
}


/**
 * This is the default 'index' action that is invoked
 * when an action is not explicitly requested by users.
 */
public function actionIndex(){


	// TODO - закешировать на 4 hour
	if($this->beginCache('main-gdz-page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('page'))) ){

		$this->breadcrumbs = array(
			'ГДЗ'
		);


		// все классы
		$this->allClasModel = GdzClas::model()->cache(86400)->findAll();

		$this->pageTitle = 'ГДЗ, готові домашні завдання, гдз онлайн Україна, збірники гдз';
		// $this->canonical = Yii::app()->createAbsoluteUrl('/gdz');
		$page = Yii::app()->getRequest()->getParam('page', null);
		if($page){
			$this->pageTitle .= ' / Сторінка '.$page;
			$this->description .= ' / Сторінка '.$page;
		}

		$criteria = new CDbCriteria;
		$criteria->condition = 't.public=1';
		$criteria->addCondition('t.public_time<'.time());

		$books = new CActiveDataProvider('GdzBook',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>12,'pageVar'=>'page')));

		// кешируем сдесь html страницы
		$this->render('index', array('books'=>$books, 'page'=>$page));

		$this->endCache(); 
	}

}

/**
 * [actionClas description]
 * @return [type] [description]
 */
public function actionClas($clas){

	// TODO - закешировать на сутки
	if($this->beginCache('gdz_clas_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'page'))) ){
		
		$this->checkClas($clas);

		$this->clasModel = $this->loadClas($clas);

		$this->breadcrumbs = array(
			'ГДЗ' => $this->createUrl('/gdz'),
			$clas . ' клас'

		);

		$this->setMeta();
		$this->description = 'ГДЗ - готові домашні завдання для ' . $clas . ' класу середніх загальноосвітніх шкіл України.';

		$page = Yii::app()->getRequest()->getParam('page', null);
		if($page){
			$this->pageTitle .= ' / Сторінка '.$page;
			$this->description .= ' / Сторінка '.$page;
		}

		$this->keywords = 
			'ГДЗ - готові домашні завдання '.$clas.' клас, 
			гдз '.$clas. ' клас, 
			гдз онлайн '.$clas. ' клас, 
			гдз '.$clas. ' клас Україна, 
			гдз решебники '.$clas.' клас, 
			готові домашні завдання '.$this->clasModel->clas->title.' клас, 
			гдз '.$this->clasModel->clas->title.' клас';

		// $this->h1 = 'ГДЗ '.(int)$clas.' клас';
		// $this->pageTitle = 'SHKOLYAR.INFO - '.$this->h1;
		// $this->canonical = Yii::app()->createAbsoluteUrl('/gdz/'.$clas);


		$criteria = new CDbCriteria;
		$criteria->condition = 't.gdz_clas_id='.$this->clasModel->id;
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());

		$books = new CActiveDataProvider('GdzBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12,'pageVar'=>'page'),
			)
		);

		$this->render('clas', array('books'=>$books, 'page'=>$page));

		$this->endCache(); 
	}
}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionSubject($clas, $subject){

	// TODO - закешировать на сутка
	if($this->beginCache('gdz_subject_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'subject', 'page'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);

		$this->keywords = 'ГДЗ - готові домашні завдання ' . $this->subjectModel->subject->title . ' ' 
			.$clas.' клас, гдз '. $this->subjectModel->subject->title . ' ' .$clas.' клас, гдз онлайн '
			. $this->subjectModel->subject->title . ' ' .$clas. ' клас, гдз '. $this->subjectModel->subject->title . ' ' .$clas. ' клас Україна, гдз решебники '
			. $this->subjectModel->subject->title . ' ' .$clas.' клас, готові домашні завдання '. $this->subjectModel->subject->title . ' ' .$this->clasModel->clas->title.' клас, гдз '. $this->subjectModel->subject->title . ' ' .$this->clasModel->clas->title.' клас';

		$this->description = 'ГДЗ - готові домашні завдання ' 
			. $this->subjectModel->subject->title . ' ' .$clas.' клас, для середніх загальноосвітніх шкіл України.';

		// $this->h1 = 'ГДЗ '.(int)$clas.' клас '. $this->subjectModel->subject->title;
		// $this->pageTitle = 'SHKOLYAR.INFO - '.$this->h1;
		// $this->canonical = Yii::app()->createAbsoluteUrl('/gdz/'.$clas.'/'.$subject);
		$this->setMeta();

		$page = Yii::app()->getRequest()->getParam('page', null);
		if($page){
			$this->pageTitle .= ' / Сторінка '.$page;
			$this->description .= ' / Сторінка '.$page;
		}

		$criteria = new CDbCriteria;
		$criteria->condition = 't.gdz_clas_id='.$this->clasModel->id;
		$criteria->addCondition('t.gdz_subject_id='.$this->subjectModel->id);
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());

		$books = new CActiveDataProvider('GdzBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12,'pageVar'=>'page'),
			)
		);

		$this->breadcrumbs = array(
			'ГДЗ' => $this->createUrl('/gdz'),
			$clas . ' клас' => $this->createUrl('/gdz/'.$clas),
			$this->subjectModel->subject->title
		);

		$this->render('subject', array('books'=>$books, 'page'=>$page));

		$this->endCache(); 
	}
}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionCurrentSubject($subject){
	// print_r($_POST);
	// die;

	// TODO - закешировать на сутка
	if($this->beginCache('gdz_current_subject_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('subject', 'page'))) ){

		// все классы
		$this->allClasModel = GdzClas::model()->cache(86400)->findAll();

		$this->checkSubject($subject);

		$subjectModel = Subject::model()->findByAttributes(array('slug'=>$subject));
		if(!$subjectModel){
			throw new CHttpException('404', 'немае такого предмету');
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.public=1');
		$criteria->addCondition('t.public_time<'.time());

		if($subjectModel){
			$curentSubjectModel = array_keys( CHtml::listData( GdzSubject::model()->findAllByAttributes(array('subject_id'=>$subjectModel->id)), 'id', 'id' ) );
			// unset($subjectModel);
			if($curentSubjectModel){
				$criteria->addInCondition('gdz_subject_id', $curentSubjectModel);
				unset($curentSubjectModel);
			}
		}

		$description = $this->getDescription($subjectModel->id);

		$books = new CActiveDataProvider('GdzBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12,'pageVar'=>'page'),
			)
		);

		// print_r($book);
		// die;

		$this->keywords = 'ГДЗ - готові домашні завдання ' . $subjectModel->title . ', гдз '. $subjectModel->title . ', гдз онлайн '
			. $subjectModel->title . ', гдз '. $subjectModel->title . ' україна, гдз решебники '
			. $subjectModel->title . ', готові домашні завдання '. $subjectModel->title . ', гдз '. $subjectModel->title;

		$this->description = 'ГДЗ - готові домашні завдання ' 
			. $subjectModel->title . ', для середніх загальноосвітніх шкіл України.';

		$this->h1 = 'ГДЗ '.$subjectModel->title;
		$this->pageTitle = $this->h1;

		$page = Yii::app()->getRequest()->getParam('page', null);
		if($page){
			$this->pageTitle .= ' / Сторінка '.$page;
			$this->description .= ' / Сторінка '.$page;
		}
		
		// $this->canonical = Yii::app()->createAbsoluteUrl('/gdz/'.$subject);

		$this->breadcrumbs = array(
			'ГДЗ' => $this->createUrl('/gdz'),
			// $subjectModel->title => $this->createUrl('/gdz/'.$subject),
			$subjectModel->title
		);

		$this->render('current_subject', array('books' => $books, 'subject'=>$subjectModel, 'description'=>$description, 'page'=>$page));

		$this->endCache(); 
	}
}


/**
 * [actionBook description]
 * @return [type] [description]
 */
public function actionBook( $clas, $subject, $book ){

	// TODO - закешировать на сутка
	if($this->beginCache('gdz_book_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'subject', 'book'))) ){
		
		$path = Yii::app()->theme->basePath;
	    $mainAssets = Yii::app()->AssetManager->publish($path);
		Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/panzoom.js', CClientScript::POS_END);

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);


		$this->keywords = 'ГДЗ - готові домашні завдання ' . $this->subjectModel->subject->title . ' ' 
			.$clas.' клас ' . $this->bookModel->author . ', гдз '. $this->subjectModel->subject->title . ' ' .$clas.' клас ' . $this->bookModel->author . ', гдз онлайн '
			. $this->subjectModel->subject->title . ' ' .$clas. ' клас ' . $this->bookModel->author . ', гдз '. $this->subjectModel->subject->title . ' ' .$clas. ' клас ' . $this->bookModel->author . ' україна, гдз решебники '
			. $this->subjectModel->subject->title . ' ' .$clas.' клас ' . $this->bookModel->author . ', готові домашні завдання '. $this->subjectModel->subject->title . ' ' .$this->clasModel->clas->title.' клас ' . $this->bookModel->author . ', гдз '. $this->subjectModel->subject->title . ' ' .$this->clasModel->clas->title.' клас ' . $this->bookModel->author . '';

		$this->description = 'ГДЗ - готові домашні завдання ' 
			. $this->subjectModel->subject->title . ' ' .$clas.' клас ' . $this->bookModel->author . ', для середніх загальноосвітніх шкіл України.';


		$this->breadcrumbs = array(
			'ГДЗ' => $this->createUrl('/gdz'),
			$clas . ' клас' => $this->createUrl('/gdz/'.$clas),
			$this->subjectModel->subject->title => $this->createUrl('/gdz/'.$clas.'/'.$subject),
			$this->bookModel->author
		);

		// $this->h1 = 'ГДЗ '.(int)$clas.' клас '. $this->subjectModel->subject->title . ' ' .$this->bookModel->author;
		// $this->pageTitle = 'SHKOLYAR.INFO - '.$this->h1;
		// $this->canonical = Yii::app()->createAbsoluteUrl('/gdz/'.$clas.'/'.$subject.'/'.$book);\
		$this->setMeta();

		$this->render('book');

		$this->endCache(); 
	
	}
}

/**
 * 
 * @return [type] [description]
 */
public function actionTask($clas, $subject, $book, $task){

	// sleep(5);

	// TODO - закешировать на 30 days
	if($this->beginCache('task_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas', 'subject', 'book','task'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);

		$pathImg['path'] = 'gdz/' . $clas . '/' 
		. $subject . '/' 
		. $book . '/task/'
		. $task .'.png';
		
		if( ! file_exists( Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
			$_GET = null;
			throw new CHttpException('404', 'такого задания в этом учебнике нету');
		}

		$imgSize = getimagesize( Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
		$pathImg['width'] = $imgSize[0];
		$pathImg['height'] = $imgSize[1];
		// $pathImg['width'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . 'images/' . $pathImg['path'])[0];


		if(Yii::app()->request->isAjaxRequest){
				
			echo  CHtml::image( 
				Yii::app()->baseUrl .'/img/'.$pathImg['path'],
				'ГДЗ - готові домашні завдання '
				.$this->subjectModel->subject->title . ' '
				.$this->param['clas']
				.' клас '.$this->bookModel->author
				.' рішення до завдяння '
				. $this->param['task'],
			array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'],'data-height'=>$pathImg['height'], 'title'=> 'ГДЗ - готові домашні завдання ' .$this->subjectModel->subject->title . ' '
				. $clas .' клас '.$this->bookModel->author.' рішення до завдяння '. $task));

			$this->endCache(); 
			
			Yii::app()->end();

	    } else {
	    	$this->render('task', array('task'=>$pathImg));
	    }


		$this->endCache(); 
	
	}

}	

/**
 * 
 * @return [type] [description]
 */
public function actionNestedOne($clas, $subject, $book, $section, $task){

	// TODO - закешировать на 30 days
	if($this->beginCache('task_nested_one_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas','subject','book','section','task'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);

		$path = 'gdz/' . $clas 
		. '/' . $subject 
		. '/' . $book . '/task/';

		$sections = scandir('img/' . $path);
		$pathImg= array();
		foreach($sections as $oneSection){

			if($subject=='lang-en'){
				$section = (int)$section . '_Урок ' . (int)$section;
			}

			if((int)$oneSection == (int)$section){
				$pathImg['path'] = $path . $oneSection . '/' . $task . '.png';
			}
		}

		if( ! file_exists( Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
			$_GET = null;
			throw new CHttpException('404', 'такого задания в этом учебнике нету');
		}

		$imgSize = getimagesize(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
		$pathImg['width'] = $imgSize[0];
		$pathImg['height'] = $imgSize[1];

		if(Yii::app()->request->isAjaxRequest){
				
			echo  CHtml::image(Yii::app()->baseUrl . '/img/' . $pathImg['path'],
			'ГДЗ - готові домашні завдання '
				.$this->subjectModel->subject->title . ' '
				.$this->param['clas']
				.' клас '.$this->bookModel->author
				.' рішення до завдяння '
				. $section . '/' . $task,
			array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'],'data-height'=>$pathImg['height'], 'title'=>'ГДЗ - ' .$this->subjectModel->subject->title . ' '
				. $clas .' клас '.$this->bookModel->author.' рішення до завдяння '. $task ));
			

			$this->endCache(); 

			Yii::app()->end();

	    }

    	$this->render('task', array('task'=>$pathImg));
	    
	    $this->endCache(); 

	}
}


/**
 * 
 * @return [type] [description]
 */
public function actionNestedTwo($clas, $subject, $book, $section, $paragraph ,$task){

	// TODO - закешировать на 30 days
	if($this->beginCache('task_nested_one_page', array('duration'=>self::CACHE_TIME, 'varyByParam'=>array('clas','subject','book','section', 'paragraph','task'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);



		//TODO переделать под авто определение 
		$img = $task . '.png';

		$path = 'gdz/' . $clas 
		. '/' . $subject
		. '/' . $book . '/task/';

		$sections = scandir('img/' . $path);
		foreach($sections as $oneSection){
			
			if((int)$oneSection == (int)$section){

				$parags =  scandir('img/' . $path . '/' . $oneSection);
				foreach($parags as $p => $parag){

					if( (int)$parag == $paragraph ){
						$pathImg['path'] =$path . $oneSection . '/' . $parag . '/' . $task . '.png';
					}
				}
			}
		}
		

		if( ! file_exists(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
			$_GET = null;
			throw new CHttpException('404', 'такого задания в этом учебнике нету');
		}

		$imgSize = getimagesize(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
		$pathImg['width'] = $imgSize[0];
		$pathImg['height'] = $imgSize[1];
		// $pathImg['width'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . 'images/' . $pathImg['path'])[0];


		if(Yii::app()->request->isAjaxRequest){
				
			echo  CHtml::image(Yii::app()->baseUrl . '/img/' . $pathImg['path'], 'ГДЗ - готові домашні завдання '
				.$this->subjectModel->subject->title . ' '
				.$this->param['clas']
				.' клас '.$this->bookModel->author
				.' рішення до завдяння '
				. $section . '/' . $paragraph . '/' . $task,
			array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'],'data-height'=>$pathImg['height'], 'title'=>'ГДЗ - ' .$this->subjectModel->subject->title . ' '
				. $clas .' клас '.$this->bookModel->author.' рішення до завдяння '. $task ));
			
			$this->endCache(); 

			Yii::app()->end();

	    }

		$this->render('task', array('task'=>$pathImg));

	    $this->endCache(); 

	}

}




/**
 * This is the action to handle external exceptions.
 */
public function actionError(){
	
	if($error=Yii::app()->errorHandler->error){
		if(Yii::app()->request->isAjaxRequest){
			echo $error['message'];
		} else {
			$this->clasModel = Clas::model()->findAll();
			$this->render('error'.$error['code'], array('error'=>$error['message']));
		}
	}
}

/**
 * [loadGdzClas description]
 * @param  [type] $clas [description]
 * @return [type]       [description]
 */
private function loadClas($clas, $category = 'gdz'){

	$model = ucfirst($category) . 'Clas';
	$clasModel = Clas::model()->cache(86400)->find('slug=:clas',array(':clas'=>(int)$clas));
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

	$subjectModel = Subject::model()->cache(86400)->findByAttributes(array('slug'=>$subject));
	// модель предмета
	if( ! $subjectModel){
		throw new CHttpException('404', 'нет такого предмета');
	}

	// модель предмета
	$criteria=new CDbCriteria;
	$criteria->condition='gdz_clas_id=:classId';
	$criteria->addCondition('subject_id=:subjectId');
	$criteria->params = array(':classId'=>$this->clasModel->id, ':subjectId'=>$subjectModel->id);
	$gdzSubjectModel = GdzSubject::model()->find($criteria);

	// проверка на наличие предмета
	if( ! $gdzSubjectModel){
		throw new CHttpException('404', 'нет такого предмета');
	}
	
	return $gdzSubjectModel;
}

private function loadBook($book){
	// модель книги
	$criteria=new CDbCriteria;
	$criteria->condition='gdz_clas_id=:classId';
	$criteria->addCondition('gdz_subject_id=:subjectId');
	$criteria->addCondition('slug=:slug');
	$criteria->addCondition('t.public_time<'.time());
	$criteria->addCondition('t.public=1');
	$criteria->params = array(
	    ':classId'=>$this->clasModel->id, 
	    ':subjectId'=>$this->subjectModel->id,
	    ':slug'=>$book
	);
	$gdzBookModel = GdzBook::model()->cache(86400)->public()->find($criteria);

	// проверка на наличие учебника
	if( ! $gdzBookModel ){
		throw new CHttpException('404', 'нет такого учебника');
	}

	return $gdzBookModel;
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
		$this->h1 = 'ГДЗ '. $this->clasModel->clas->slug.' клас';
		// $this->canonical = '/gdz/'.$this->clasModel->clas->slug;
	}

	if($this->subjectModel){
		$this->h1 .= ' ' . $this->subjectModel->subject->title . ' ';
		// $this->canonical .= '/'.$this->subjectModel->subject->slug;
	}

	if($this->bookModel){
		$this->h1 .= $this->bookModel->author;
		// $this->canonical .= '/'.$this->bookModel->slug;
	}

	$this->pageTitle = $this->h1;
}


public function checkerBook($clas, $subject, $book){

	$bookClas = $this->loadClas($clas, 'textbook');
	// print_r($bookClas);
	// die;
   	$bookSubject = $this->loadSubject($subject, 'textbook');
 
	$criteria = new CDbCriteria;
	$criteria->condition='textbook_clas_id=:classId';
	$criteria->addCondition('textbook_subject_id=:subjectId');
	$criteria->addCondition('slug=:slug');
	$criteria->params = array(
	    ':classId' => $bookClas->id, 
	    ':subjectId' => $bookSubject->id,
	    ':slug' => $book
	);


	return TextbookBook::model()->count($criteria);

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