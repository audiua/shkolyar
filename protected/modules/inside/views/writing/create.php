<?php
/* @var $this WritingController */
/* @var $model Writing */

$this->breadcrumbs=array(
	'Writings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Writing', 'url'=>array('index')),
	array('label'=>'Manage Writing', 'url'=>array('admin')),
);
?>

<h1>Create Writing</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>