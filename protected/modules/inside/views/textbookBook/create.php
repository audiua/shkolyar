<?php
/* @var $this TextbookBookController */
/* @var $model TextbookBook */

$this->breadcrumbs=array(
	'Textbook Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TextbookBook', 'url'=>array('index')),
	array('label'=>'Manage TextbookBook', 'url'=>array('admin')),
);
?>

<h1>Create TextbookBook</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>