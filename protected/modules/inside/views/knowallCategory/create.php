<?php
/* @var $this KnowallCategoryController */
/* @var $model KnowallCategory */

$this->breadcrumbs=array(
	'Knowall Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KnowallCategory', 'url'=>array('index')),
	array('label'=>'Manage KnowallCategory', 'url'=>array('admin')),
);
?>

<h1>Create KnowallCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>