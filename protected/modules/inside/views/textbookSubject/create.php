<?php
/* @var $this TextbookSubjectController */
/* @var $model TextbookSubject */

$this->breadcrumbs=array(
	'Textbook Subjects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TextbookSubject', 'url'=>array('index')),
	array('label'=>'Manage TextbookSubject', 'url'=>array('admin')),
);
?>

<h1>Create TextbookSubject</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>