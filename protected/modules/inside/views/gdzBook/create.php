<?php
/* @var $this GdzBookController */
/* @var $model GdzBook */

$this->breadcrumbs=array(
	'Gdz Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GdzBook', 'url'=>array('index')),
	array('label'=>'Manage GdzBook', 'url'=>array('admin')),
);
?>

<h1>Create GdzBook</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>