<?php
/* @var $this GdzSubjectController */
/* @var $model GdzSubject */

$this->breadcrumbs=array(
	'Gdz Subjects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GdzSubject', 'url'=>array('index')),
	array('label'=>'Manage GdzSubject', 'url'=>array('admin')),
);
?>

<h1>Create GdzSubject</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>