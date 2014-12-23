<?php
/* @var $this KnowallController */
/* @var $model Knowall */

$this->breadcrumbs=array(
	'Knowalls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Knowall', 'url'=>array('index')),
	array('label'=>'Manage Knowall', 'url'=>array('admin')),
);
?>

<h1>Create Knowall</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>