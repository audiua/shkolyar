<?php

/**
 * конроллер учебников
 */
class TextbookController extends Controller{

public $layout='';
public $canonical;

/**
 *  @var string  мета тег ключевых слов
 */
public $keywords='Підручники для середніх загальноосвітніх шкіл України';

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
	$this->pageTitle = 'SHKOLYAR.INFO - Підручники';

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

	// print_r('textbook');
	// die;


	// TODO - закешировать на сутки
	if($this->beginCache('main-textbook-page', array('duration'=>86400)) ){

		$this->breadcrumbs = array(
			'Підручники'
		);

		$this->allClasModel = TextbookClas::model()->findAll();

		// print_r($this->allClasModel);
		// die;

		$textbooks = new CActiveDataProvider('TextbookBook',array('pagination'=>array('pageSize'=>12)));

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
	if($this->beginCache('clas_textbook_page'.$clas, array('duration'=>86400, 'varyByParam'=>array('clas'))) ){

		$this->checkClas($clas);
		$this->clasModel = $this->loadClas($clas);

		$this->setMeta();
		
		$this->breadcrumbs = array(
			'Підручники' => $this->createUrl('/textbook'),
			$clas . ' клас'
		);


		$this->keywords = 'Підручники '.$clas.' клас, гдз '.$clas. ' клас, Підручники онлайн '.$clas. ' клас, Підручники '.$clas. ' клас україна, Підручники '.$clas.' клас, Підручники '.$this->clasModel->clas->title.' клас';
		$this->description = 'Підручники для ' . $clas . ' класу середніх загальноосвітніх шкіл України.';

		// $books = new CActiveDataProvider('GdzBook', 
		// 	array(
		// 		'criteria'=>array(
		// 			'condition'=>'gdz_clas_id='.$this->clasModel->id,
		// 		), 
		// 		'pagination'=>array('pageSize'=>12),
		// 	)
		// );

		$this->render('clas');


		$this->endCache(); 
	}
}

/**
 * [actionSubject description]
 * @return [type]          [description]
 */
public function actionSubject($clas, $subject){

	// TODO - закешировать на сутка
	if($this->beginCache('subject_textbook_page'.$clas.$subject, array('duration'=>86400, 'varyByParam'=>array('clas', 'subject'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);

		$this->setMeta();

		$this->keywords = 'Підручники ' . $this->subjectModel->subject->title . ' ' 
			.$clas.' клас, Підручники '. $this->subjectModel->subject->title . ' ' .$clas.' клас, Підручники онлайн '
			. $this->subjectModel->subject->title . ' ' .$clas. ' клас, Підручники '. $this->subjectModel->subject->title . ' ' .$clas. ' клас україна, Підручники '
			. $this->subjectModel->subject->title . ' ' .$clas.' клас, Підручники '. $this->subjectModel->subject->title . ' ' .$this->clasModel->clas->title.' клас, Підручники '. $this->subjectModel->subject->title . ' ' .$this->clasModel->clas->title.' клас';

		$this->description = 'Підручники ' 
			. $this->subjectModel->subject->title . ' ' .$clas.' клас, для середніх загальноосвітніх шкіл України.';

		$criteria = new CDbCriteria;
		$criteria->condition = 't.textbook_clas_id='.$this->clasModel->id;
		$criteria->addCondition('t.textbook_subject_id='.$this->subjectModel->id);
		$criteria->addCondition('t.public=1');

		$books = new CActiveDataProvider('TextbookBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12),
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
	// print_r($_POST);
	// die;

	// TODO - закешировать на сутка
	if($this->beginCache('gdz_current_subject_page'.$subject, array('duration'=>1000, 'varyByParam'=>array('subject'))) ){

		// все классы
		$this->allClasModel = GdzClas::model()->findAll();

		$this->checkSubject($subject);

		$subjectModel = Subject::model()->findByAttributes(array('slug'=>$subject));
		if(!$subjectModel){
			throw new CHttpException('404', 'немае такого предмету');
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.public=1');

		if($subjectModel){
			$curentSubjectModel = array_keys( CHtml::listData( GdzSubject::model()->findAllByAttributes(array('subject_id'=>$subjectModel->id)), 'id', 'id' ) );
			// unset($subjectModel);
			if($curentSubjectModel){
				$criteria->addInCondition('gdz_subject_id', $curentSubjectModel);
				unset($curentSubjectModel);
			}
		}

		$books = new CActiveDataProvider('GdzBook', 
			array(
				'criteria'=>$criteria, 
				'pagination'=>array('pageSize'=>12),
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
		$this->pageTitle = 'SHKOLYAR.INFO - '.$this->h1;
		$this->canonical = Yii::app()->createAbsoluteUrl('/gdz/'.$subject);

		$this->breadcrumbs = array(
			'ГДЗ' => $this->createUrl('/gdz'),
			// $subjectModel->title => $this->createUrl('/gdz/'.$subject),
			$subjectModel->title
		);

		$this->render('current_subject', array('books' => $books, 'subject'=>$subjectModel));

		$this->endCache(); 
	}
}


/**
 * [actionBook description]
 * @return [type] [description]
 */
public function actionBook( $clas, $subject, $book ){



	// TODO - закешировать на сутка
	if($this->beginCache('book_textbook_page'.$clas.$subject.$book, array('duration'=>86400, 'varyByParam'=>array('clas', 'subject', 'book'))) ){


		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);

		$this->setMeta();
		$this->keywords = '';
		$this->description = '';

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
	if($this->beginCache('task_textbook_page'.$clas.$subject.$book.$task, array('duration'=>86400, 'varyByParam'=>array('clas', 'subject', 'book','task'))) ){

		$this->checkClas($clas);
		$this->checkSubject($subject);
		$this->checkBook($book);

		$this->clasModel = $this->loadClas($clas);
		$this->subjectModel = $this->loadSubject($subject);
		$this->bookModel = $this->loadBook($book);

		if(isset($this->param['unit']) && $this->param['unit'] > 0){
			$unit = 'unit_'.$this->param['unit'] . '/';
		} else {
			$unit = '';
		}

		if(isset($this->param['page'])){
			$pathImg['path'] = 'textbook/' . $this->param['clas'] . '/' 
			. $this->param['subject'] . '/' 
			. $this->param['book'] . '/task/' 
			. $unit
			. 'lesson_' . $this->param['lesson'] . '/' 
			. $this->param['page'] . '_' 
			. $this->param['task'] .'.png';
		} elseif(isset($this->param['lesson'])){
			$pathImg['path'] = 'textbook/' . $this->param['clas'] . '/' 
			. $this->param['subject'] . '/' 
			. $this->param['book'] . '/task/' 
			. $unit
			. 'lesson_' . $this->param['lesson'] . '/' 
			. $this->param['task'] .'.png';
		} else {
			$pathImg['path'] = 'textbook/' . $this->param['clas'] . '/' 
			. $this->param['subject'] . '/' 
			. $this->param['book'] . '/task/'
			. $this->param['task'] .'.png';
		}

		if( ! file_exists(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
			throw new CHttpException('404', 'такого завдання у цьому пидручнику немае');
		}

		$imgSize = getimagesize(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
		$pathImg['width'] = $imgSize[0];
		// $pathImg['width'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . 'images/' . $pathImg['path'])[0];


		if(Yii::app()->request->isAjaxRequest){
				
			echo  CHtml::image(Yii::app()->baseUrl . '/img/' . $pathImg['path'], '',
			array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'], 'title'=> ''));

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
public function actionNestedOne(){

	$path = 'gdz/' . $this->param['clas'] 
	. '/' . $this->param['subject'] 
	. '/' . $this->param['book'] . '/task/';

	

	$sections = scandir('img/' . $path);
	foreach($sections as $section){

		if($this->param['subject']=='lang_en'){
			$section = (int)$section . '_Урок ' . (int)$section;
		}

		if((int)$section == (int)$this->param['section']){
			$pathImg['path'] = $path . $section . '/' . $this->param['task'] . '.png';
		}
	}

	if( ! file_exists(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path'])){
		$_GET = null;
		throw new CHttpException('404', 'такого задания в этом учебнике нету');
	}

	$imgSize = getimagesize(Yii::app()->basePath . '/../' . 'img/' . $pathImg['path']);
	$pathImg['width'] = $imgSize[0];
	// print_r($pathImg['width']);
	// die;

	// echo $path;
	// die;

	if(Yii::app()->request->isAjaxRequest){
			
		echo  CHtml::image(Yii::app()->baseUrl . '/img/' . $pathImg['path'], ' ' ,
		array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'] ));
		
		Yii::app()->end();

    } else {
    	$this->render('task', array('task'=>$pathImg));
    }

	// $this->render('task',['task'=>$pathImg]);
}


/**
 * 
 * @return [type] [description]
 */
public function actionNestedTwo(){

	$img = $this->param['task'] . '.png';

	if( isset($this->param['section']) ){

		$path = 'gdz/' . $this->param['clas'] 
		. '/' . $this->param['subject'] 
		. '/' . $this->param['book'] . '/task/';

		$sections = scandir('img/' . $path);
		foreach($sections as $section){
			
			if((int)$section == (int)$this->param['section']){

				$parags =  scandir('img/' . $path . '/' . $section);
				foreach($parags as $p => $parag){

					if( (int)$parag == $this->param['paragraph'] ){
						$pathImg['path'] =$path . $section . '/' . $parag . '/' . $this->param['task'] . '.png';
					}
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
	// $pathImg['width'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . 'images/' . $pathImg['path'])[0];


	if(Yii::app()->request->isAjaxRequest){
			
		echo  CHtml::image(Yii::app()->baseUrl . '/img/' . $pathImg['path'], ' ' ,
		array('class'=>' task-img panzoom ', 'data-width'=>$pathImg['width'] ));
		
		Yii::app()->end();

    } else {
    	$this->render('task', array('task'=>$pathImg));
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

	$this->pageTitle = 'SHKOLYAR.INFO - '.$this->h1;
}


public function checkerBook($clas, $subject, $book){

	$bookClas = $this->loadClas($clas, 'gdz');
   	$bookSubject = $this->loadSubject($subject, 'gdz');
 
	$criteria = new CDbCriteria;
	$criteria->condition='gdz_clas_id=:classId';
	$criteria->addCondition('gdz_subject_id=:subjectId');
	$criteria->addCondition('slug=:slug');
	$criteria->params = array(
	    ':classId' => $bookClas->id, 
	    ':subjectId' => $bookSubject->id,
	    ':slug' => $book
	);


	return GdzBook::model()->count($criteria);

}



}